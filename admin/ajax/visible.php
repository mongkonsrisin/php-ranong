<?php
require ("../config/session.php");

if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
require ("../config/dbconfig.php");


$id = $_GET['id'];
$table = $_GET['table'];
$visible = $_GET['visible'];

if($table=='poi') {
$sql = "UPDATE tbl_poi SET poi_show=$visible WHERE poi_id=$id";
}
if($table=='slider') {
    $sql = "UPDATE tbl_slider SET sld_show=$visible WHERE sld_id=$id";
    }
$stmt = $con->prepare($sql);
$stmt->execute();

?>
