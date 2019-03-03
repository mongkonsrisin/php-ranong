<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
//$dbhost = "192.168.1.31";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ranongweb_db";
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$con->set_charset("utf8");
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
?>