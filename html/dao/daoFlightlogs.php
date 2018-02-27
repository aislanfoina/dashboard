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
							`id_drone` int(9) unsigned NOT NULL DEFAULT 0,
							`begin` timestamp,
							`end` timestamp, 
                            `summary` text,
                            `subjects` text,
                            `blocks` text,
                            `keywords` text,
							`versions` text,
                            `participants` text,
							`id_status` int(3) unsigned DEFAULT 0,
							`id_owner` int(6) unsigned NOT NULL DEFAULT 0,
							`creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
							PRIMARY KEY (`id`),
							KEY `id` (`id`)
						)";
	
	public $fields = array("flightlogs.id", "flightlogs.id_drone", "flightlogs.begin", "flightlogs.end", "flightlogs.summary", "flightlogs.subjects", "flightlogs.blocks", "flightlogs.keywords", "flightlogs.versions", "flightlogs.participants", "flightlogs.id_owner",
						"drones.name",
						"status.status");
	public $join = "LEFT JOIN drones ON flightlogs.id_drone = drones.id
					LEFT JOIN status ON flightlogs.id_status = status.id";

	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "flightlogs";
		if(!$this->checkTable()) {
			$data['id_drone'] = "1";
			$data['begin'] = "2018-02-26 12:00:00";
			$data['end'] = "2018-02-26 14:00:00";
			$data['summary'] = "Dummy test report";
			$data['subjects'] = "Test Dashboard features";
			$data['blocks'] = "vision,flight,dispatch";
			$data['keywords'] = "crash";
			$data['versions'] = "gs_6.6,vision_10,flight_11";
			$data['participants'] = "Aislan,Guy";
			$data['id_status'] = "1";
			$data['id_owner'] = "0";
			$this->insert($data);
		}
	}
	
	public function getFlightbyId($id) {
		$where = "flightlogs.id = '$id'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
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