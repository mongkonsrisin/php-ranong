<?php
//ini_set('error_reporting',0);
/*
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    if(!headers_sent()) {
        header("Status: 301 Moved Permanently");
        header(sprintf(
            'Location: https://%s%s',
            $_SERVER['HTTP_HOST'],
            $_SERVER['REQUEST_URI']
        ));
        exit();
    }
}
*/
//$base_url = "https://reg.ssru.ac.th/lovenaranong/";  // for Production
$base_url = "localhost/lovenaranong/";  // for Developer
//$con =	mysqli_connect("192.168.1.31","ranong","ranong#2018db","ranongweb_db");
$con =	mysqli_connect("localhost","root","","ranongweb_db");
mysqli_query($con,"SET NAMES UTF8");
?>
