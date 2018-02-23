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

class Drones extends Crud{
	public $creation = "CREATE TABLE `drones` (
							`id` int(9) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(50) NOT NULL DEFAULT 'undef',
							`id_model` varchar(50) NOT NULL DEFAULT 'undef',
							`version` varchar(10) NOT NULL DEFAULT '0',
							`id_status` int(3) unsigned DEFAULT 0,
							`creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
							PRIMARY KEY (`id`),
							KEY `id` (`id`)
						)";
	
	public $fields = array("drones.id", "drones.name", "drones.id_model", "drones.version",      
						"status.status");
	public $join = "LEFT JOIN status ON drones.id_status = status.id";

	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "drones";
		$this->checkTable();
	}
	
	public function getDrones($where = null, $order = null) {
		return $this->read($this->fields,$where,null,null,$order,$this->join);
	}
}
?>