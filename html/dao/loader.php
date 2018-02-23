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

session_start();

$logged = false;
if(isset($_SESSION[$cfgPrefix.'_isLogged'])) {
	$logged = $_SESSION[$cfgPrefix.'_userId'];
}

// if (isset($_SESSION[$cfgPrefix.'_User'])) {
// 	$colname_login = (get_magic_quotes_gpc()) ? $_SESSION[$cfgPrefix.'_User'] : addslashes($_SESSION[$cfgPrefix.'_User']);
// 	$query_top_login = sprintf("SELECT *, role.id as role_id FROM users LEFT JOIN role ON role.id = users.id_role WHERE email like '%s' AND users.id_status != 2", $colname_login);
// 	$top_login = mysql_query($query_top_login, $gtp);// or die(mysql_error());
// 	$row_top_login = mysql_fetch_array($top_login, MYSQL_BOTH);
// 	$row_top_login['id'] = $row_top_login[0];
// 	$row_login = $row_top_login;
// 	$totalRows_top_login = mysql_num_rows($top_login);
// 	if($totalRows_top_login > 0)
// 		$logged = true;
// }

require_once("crud.php");
$cred = new Credential($db_username, $db_password, $db_database, $db_hostname, $siteDebug, ($logged?$logged:0));
$crud = new Crud($cred);
$dao = array();

foreach (glob("../dao/dao*.php") as $daoClass) {
	require_once $daoClass;
	$tmp_arr = explode("/",$daoClass);
	$tmp_arr = explode(".",end($tmp_arr));
	$fullname = reset($tmp_arr);
	$shortname = substr($fullname, 3);

	$dao[strtolower($shortname)] = new $shortname($cred); 
}

// require_once("daoUsers.php");
// require_once("daoDevices.php");
// require_once("daoDrones.php");
// require_once("daoFlylogs.php");
// require_once("daoSubscribers.php");
// require_once("daoRole.php");
// require_once("daoStatus.php");
// $dao['users'] = new Users($cred);
// $dao['devices'] = new Devices($cred);
// $dao['drones'] = new Drones($cred);
// $dao['flylogs'] = new Flylogs($cred);
// $dao['subscribers'] = new Subscribers($cred);
// $dao['role'] = new Role($cred);
// $dao['status'] = new Status($cred);
?>