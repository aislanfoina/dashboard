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

class Flightlogs extends Crud{
	public $creation = "CREATE TABLE `flightlogs` (
							`id` int(12) unsigned NOT NULL AUTO_INCREMENT,
							`id_drone` int(9) unsigned NOT NULL,
							`begin` timestamp,
							`end` timestamp, 
                            `summary` text,
                            `subjects` text,
                            `blocks` text,
                            `versions` text,
                            `id_participants` int(6) unsigned NOT NULL DEFAULT 0,
							`id_status` int(3) unsigned DEFAULT 0,
							`id_owner` int(6) unsigned NOT NULL,
							`creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
							PRIMARY KEY (`id`),
							KEY `id` (`id`)
						)";
	
	public $fields = array("flightlogs.id", "flightlogs.location", "flightlogs.begin", "flightlogs.end", "flightlogs.id_owner",
						"drones.name",
						"status.status");
	public $join = "LEFT JOIN drones ON flightlogs.id_drone = drones.id
					LEFT JOIN status ON flightlogs.id_status = status.id";

	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "flightlogs";
		$this->checkTable();
	}
	
	public function getFlightbyId($id) {
		$where = "flightlogs.id = '$id'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
	}
	
	public function beginFlight($id) {
		$data['id_status'] = 5;
		$data['begin'] = date("Y-m-d H:i:s");
		$where = "id = '$id'";
		return $this->update($data, $where);
	}
	
	public function endFlight($id) {
		$data['id_status'] = 6;
		$data['end'] = date("Y-m-d H:i:s");
		$where = "id = '$id'";
		return $this->update($data, $where);
	}
	
	public function savebyPrefixSpecial($prefix, $arr) {
		foreach ($arr as $param=>$value) {
			if(strstr($param,$prefix)!==false) {
				if(str_ireplace($prefix,"",$param) == "location") {
					$data[str_ireplace($prefix,"",$param)] = $value;
				}
				else
					$data[str_ireplace($prefix,"",$param)] = "'".$value."'";
			}
		}
		return $this->insertNoQuote($data);
	}
}
?>