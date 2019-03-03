<?php
//$dbhost = "192.168.1.31";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ranongweb_db";
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$con->set_charset("tis620");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
 ?>