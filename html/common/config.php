<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$cfgPrefix = "ERP";
$cfgTitle = "ERP";
$include_prefix = "./";
$url_arquivos = "http://localhost/Arquivos";
$path_arquivos = "C:/tmp";

		
// $siteDebug = false;
$siteDebug = true;

$db_hostname = "localhost";
$db_database = "dashboard";
$db_username = "root";
$db_password = "";
// $gtp = mysql_pconnect($db_hostname, $db_username, $db_password) or trigger_error(mysql_error(),E_USER_ERROR); 
// mysql_select_db($db_database, $gtp);

// session_start();

require("class.phpmailer.php");

include("../dao/loader.php");
include("functions.php");
?>