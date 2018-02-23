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
 
class Role extends Crud{
	public $creation = "CREATE TABLE `role` (
							`id` int(6) unsigned NOT NULL AUTO_INCREMENT,
							`role` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
							`id_status` int(3) unsigned DEFAULT 0,
							`Regras` int(3) DEFAULT 0,
							PRIMARY KEY (`id`),
							KEY `id` (`id`)
						)";
	
	public $fields = array("role.id", "status.status");

	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "role";
		$this->checkTable();
	}
	
	public function getUsers($where = "users.id_status != '2'", $orderby = "users.email ASC") {
		return $this->read($this->fields,$where,null,null,$orderby,$this->join);
	}
	
	public function getUsersbyId($id) {
		$where = "users.id = '$id'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
	}
	
	public function getUsersbyNameNotStatus($name, $status = 2) {
		$where = "users.email LIKE '$name' AND users.id_status != '$status'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
	}

	public function checkLogin($email, $device) {
		$users = $this->getUsersbyNamePasswordNotStatus($email, $device, 2);
		if(count($users) > 0) {
			return $users[0]['id'];
		}
		else
			return false;
	}
	
	public function getUsersbyNamePasswordNotStatus($name, $pass, $status) {
		$where = "users.email LIKE '$name' AND users.device = '$pass' AND users.id_status != '$status'";
		return $this->read($this->fields,$where,null,null,null,$this->join);
	}
	
}
?>