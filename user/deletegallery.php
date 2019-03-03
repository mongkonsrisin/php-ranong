<?php
require('config/dbconfig.php');
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
if($_GET['id'] != $_SESSION['id']) {
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
  exit();
}
$id = $_GET['id'];
$file = $_GET['f'];

$path1 = "../assets/img/photo/$id/";
$path = $path1 . $file;
@unlink($path);



echo '<meta http-equiv="refresh" content="0;url=gallerypoi.php">';

   
?>