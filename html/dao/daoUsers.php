<?php
class Users extends Crud{
	public $creation = "CREATE TABLE `users` (
							`id` int(9) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(100) NOT NULL DEFAULT 'z3r0',
							`email` varchar(100) NOT NULL,
							`phone` varchar(20) NOT NULL DEFAULT 'z3r0',
							`password` varchar(50) NOT NULL DEFAULT 'z3r0',
							`password_expired` int(1) NOT NULL DEFAULT 1,
							`id_role` int(3) unsigned DEFAULT 0,
							`id_status` int(3) unsigned DEFAULT 0,
							`id_modifier` int(6) unsigned,
							`modify_date` timestamp,
							`id_owner` int(6) unsigned NOT NULL,
							`creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
							PRIMARY KEY (`id`),
							KEY `id` (`id`),
							UNIQUE (`email`)
						)";
	
	/* rename username to name
	alter table users change column username name varchar(100) NOT NULL DEFAULT 'z3r0';
	alter table users change column cellphone phone varchar(20) NOT NULL DEFAULT 'z3r0';
	alter table users add column modify_date timestamp;
	*/
	
	public $fields = array("users.id", "users.name", "users.email", "users.phone", "users.password", "users.id_status",
						 "roles.role", "status.status");

	public $join = "LEFT JOIN roles ON users.id_role = roles.id
					LEFT JOIN status ON users.id_status = status.id";
	
	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "users";
		if(!$this->checkTable()) {
			$data['name'] = "Aislan Foina";
			$data['email'] = "aislan@foitec.com.br";
			$data['password'] = "foitec12)(";
			$data['id_status'] = "1";
			$data['id_role'] = "1";
			$data['id_owner'] = "0";
			$this->insertUser($data);
			
			$data['name'] = "Admin";
			$data['email'] = "admin@foitec.com.br";
			$data['password'] = "admin";
			$data['id_status'] = "1";
			$data['id_role'] = "1";
			$data['id_owner'] = "0";
			$this->insertUser($data);
			
			$data['name'] = "Controlador 1";
			$data['email'] = "controlador@foitec.com.br";
			$data['password'] = "controlador";
			$data['id_status'] = "1";
			$data['id_role'] = "2";
			$data['id_owner'] = "0";
			$this->insertUser($data);
				
			$data['name'] = "Diretor 1";
			$data['email'] = "diretor@foitec.com.br";
			$data['password'] = "diretor";
			$data['id_status'] = "1";
			$data['id_role'] = "3";
			$data['id_owner'] = "0";
			$this->insertUser($data);
				
			$data['name'] = "Advogado 1";
			$data['email'] = "advogado@foitec.com.br";
			$data['password'] = "advogado";
			$data['id_status'] = "1";
			$data['id_role'] = "4";
			$data['id_owner'] = "0";
			$this->insertUser($data);
				
			$data['name'] = "Sindicalizado 1";
			$data['email'] = "sindicalizado@foitec.com.br";
			$data['password'] = "sindicalizado";
			$data['id_status'] = "1";
			$data['id_role'] = "5";
			$data['id_owner'] = "0";
			$this->insertUser($data);
		}
	}
	
	
	/// Selects
	
	public function getUsers($where = "users.id_status != '2'", $orderby = "users.email ASC") {
		return $this->read($this->fields,$where,null,null,$orderby,$this->join);
	}
	
	public function getUserbyId($id) {
		$where = "users.id = '$id'";
		$users = $this->read($this->fields,$where,null,null,null,$this->join);
		if(count($users) > 0)
			return $users[0];
		else
			return false;
	}
	
	public function getUsersbyId($id) {
		$where = "users.id = '$id'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
	}
	
	public function getUsersbyNameNotStatus($name, $status = 2) {
		$where = "users.email LIKE '$name' AND users.id_status != '$status'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
	}

	public function getUsersbyNamePasswordNotStatus($name, $pass, $status) {
		$where = "users.email LIKE '$name' AND users.password = '$pass' AND users.id_status != '$status'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
	}
	
	public function checkLogin($email, $pass) {
		$users = $this->getUsersbyNamePasswordNotStatus($email, $pass, 2);
		if(count($users) > 0) {
			$where = "id = '".$users[0]['id']."'";
			$data['modify_date'] = "NOW()";
			$this->updateNoQuote($data, $where);
			return $users[0]['id'];
		}
		else
			return false;
	}
	
	/// Inserts
	public function insertUser($data) {
		return $this->insert($data);
	}
	
	
	
	/// Updates
	
	public function updateLastLogin($id) {
		$where = "id = '$id'";
		$data['modify_date'] = "NOW()";
		return $this->updateNoQuote($data, $where);
	}
	
	public function updateEmail($id, $email) {
		$where = "id = '$id'";
		$data['email'] = $email;
		return $this->update($data, $where);
	}
	
	/// Deletes
}
?>