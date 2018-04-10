<?php
/* Copyright (C) 2015 Foi.tech - All Rights Reserved
 * You may use, distribute and modify this code under the terms of
 * the FMS license, which unfortunately won't be written for another
 * century.
 *
 * You should have received a copy of the FMS license with
 * this file. If not, please write to: license@foi.tech, or
 * visit : http://foi.tech/license.pdf
 */

	class Credential{
		public $user = "root";
		public $pass = "";
		public $db = "erp";
		public $host = "localhost";
		
		public $debug = false;
		
		public $id_owner;
		
		public function __construct($user, $pass, $db, $host, $debug = false, $id_owner = "0"){
			$this->user = $user;
			$this->pass = $pass;
			$this->db = $db;
			$this->host = $host;
			$this->debug = $debug;
			$this->id_owner = $id_owner;
		}
	}
	
    class Crud{
        protected $db;
        public $user = "root";
        public $pass = "";
        public $dbase = "erp";
        public $host = "localhost";

        public $fields = null;
        public $join = null;
        public $sort = null;
        
        public $creation;
        public $table;
        
        public $debug = false;
        
		public $id_owner;
		
        public function __construct($credentials) {
         	$this->user = $credentials->user;
        	$this->pass = $credentials->pass;
        	$this->dbase = $credentials->db;
        	$this->host = $credentials->host;
	        $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbase",$this->user,$this->pass); 
	        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        
	        $this->debug=$credentials->debug;
	        $this->id_owner=$credentials->id_owner;
        }
        
	    public function __sleep()
	    {
	        return array('dbase', 'user', 'pass');
	    }
    
        public function get($filter = null) {
        	return $this->read($this->fields,$filter,null,null,$this->sort,$this->join);
        }
        
        public function getbyId($id, $filter = null) {
        	$where = $this->table.".id = '$id'";
        	 
        	$rs = $this->read($this->fields,$where,null,null,$this->sort,$this->join);
        	if(count($rs) > 0) {
        		return $rs[0];
        	}
        	else
        		return false;
        }
        
        protected function checkTable() {
            try {
            	$query = "SHOW TABLES LIKE '{$this->table}'";
	            $data = $this->db->query($query);
	            $data->setFetchMode(PDO::FETCH_ASSOC);
	            $result = $data->fetchAll();
            	if(count($result) < 1) {
					$this->db->query($this->creation);
					return false;
            	}
            } catch (PDOException $e) {
            	echo "Failed to run Query: " . $e->getMessage() . "\n";
            	exit;
            }
            return true;
        }
        
        public function addColumn($colName, $colDesc) {
        	try {
        		$query = "SHOW COLUMNS FROM {$this->table} LIKE '$colName'";
        		$data = $this->db->query($query);
        		$data->setFetchMode(PDO::FETCH_ASSOC);
        		$result = $data->fetchAll();
        		if(count($result) < 1) {
        			$query = "ALTER TABLE {$this->table} ADD COLUMN $colName $colDesc";
        			$data = $this->db->query($query);
        		}
        	} catch (PDOException $e) {
        		echo "Failed to run Query: " . $e->getMessage() . "\n";
        		exit;
        	}
        }
        
        public function insert(array $data) {
        	$campos = implode(",",array_keys($data));
        	$vl = "'".implode("','",array_values($data))."'";
        	try {
        		$query = "INSERT INTO {$this->table} ({$campos}) VALUES ({$vl})";
        		$this->logDebug($query);
        		$this->db->query($query);
        		return $this->db->lastInsertId();
        	} catch (PDOException $e) {
        		echo "Failed to run Query: " . $e->getMessage() . "\n $query \n";
        		exit;
        	}
        }
        
        public function insertNoQuote(array $data) {
            $campos = implode(",",array_keys($data));
            $vl = "".implode(",",array_values($data))."";
            try {
            	$query = "INSERT INTO {$this->table} ({$campos}) VALUES ({$vl})";
            	$this->logDebug($query);
            	$this->db->query($query);
            	return $this->db->lastInsertId();
            } catch (PDOException $e) {
            	echo "Failed to run Query: " . $e->getMessage() . "\n $query \n";
            	exit;
            }
        }

        public function insertbyTable(array $data, $table) {
        	$campos = implode(",",array_keys($data));
        	$vl = "'".implode("','",array_values($data))."'";
        	try {
        		$query = "INSERT INTO {$table} ({$campos}) VALUES ({$vl})";
        		$this->logDebug($query);
        		$this->db->query($query);
        		return $this->db->lastInsertId();
        	} catch (PDOException $e) {
        		echo "Failed to run Query: " . $e->getMessage() . "\n";
        		exit;
        	}
        }
        
        
        public function read($field = null, $where = null, $limit = null, $offset = null, $orderby = null, $join = null, $group = null) { 
            $field = ($field !=null ? implode(", ",$field) : "*");
			$where = ($where !=null ? "WHERE {$where}" : "");
            $limit = ($limit !=null ? "LIMIT {$limit}" : "");
            $offset = ($offset !=null ? "OFFSET {$offset}" : "");
            $orderby = ($orderby !=null ? "ORDER BY {$orderby}" : "");
            $join = ($join !=null ? "{$join}" : "");
            $group = ($group !=null ? "GROUP BY {$group}" : "");
			$query = "SELECT {$field} FROM {$this->table} {$join} {$where} {$group} {$orderby} {$limit} {$offset}";
			$this->logDebug($query);
			try {
	            $data = $this->db->query($query);
	            $data->setFetchMode(PDO::FETCH_ASSOC);
	            $result = $data->fetchAll();
	            return $result ;
            } catch (PDOException $e) {
            	echo "Failed to run Query ($query): " . $e->getMessage() . "\n";
            	exit;
            }
        }
        
        public function update(array $data, $where = null) {
            foreach($data as $indice => $valor){
                $campos[] = "{$indice} = '{$valor}'";
                
            }
            $where = ($where !=null ? "WHERE {$where}" : "");
            $campos = implode(", ",$campos);
            $query = "UPDATE {$this->table} SET {$campos} {$where}";
            $this->logDebug($query);
            try {
            	return $this->db->query($query);
            } catch (PDOException $e) {
            	echo "Failed to run Update ($query): " . $e->getMessage() . "\n";
            	exit;
            }
            
        }

        public function updateNoQuote(array $data, $where = null) {
        	foreach($data as $indice => $valor){
        		$campos[] = "{$indice} = {$valor}";
        
        	}
        	$where = ($where !=null ? "WHERE {$where}" : "");
        	$campos = implode(", ",$campos);
        	$query = "UPDATE {$this->table} SET {$campos} {$where}";
        	$this->logDebug($query);
        	try {
        		return $this->db->query($query);
        	} catch (PDOException $e) {
        		echo "Failed to run Update ($query): " . $e->getMessage() . "\n";
        		exit;
        	}
        
        }
        
        public function delete($where = null) {
            return $this->db->query("DELETE FROM {$this->table} WHERE {$where}");
        }
        
        private function showTable($table) {
        	$sql = "SHOW TABLE LIKE '$table'";
        	return $this->db->query($sql);
        }
        
        private function logDebug($msg) {
//         	if($this->debug)
//         		echo "<!-- >><b>Query $this->table:</b> $msg<br> -->";
      //  	trigger_error($msg, E_USER_NOTICE);
        }
        
        public function savebyPrefix($prefix, $arr) {
        	foreach ($arr as $param=>$value) {
        		if(strstr($param,$prefix)!==false) {
        			$data[str_ireplace($prefix,"",$param)] = trim($value);
        		}
        	}
        	return $this->insert($data);
        }
        
        public function updatebyPrefix($prefix, $arr, $id) {
        	$where = "id = '$id'";
        	$data['id_owner'] = $this->id_owner;
        	foreach ($arr as $param=>$value) {
        		if(strstr($param,$prefix)!==false) {
        			$data[str_ireplace($prefix,"",$param)] = $value;
        		}
        	}
        	return $this->update($data, $where);
        }
        
        
    }
?>