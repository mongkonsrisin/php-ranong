<?php
session_start();
require('config/dbconfig.php');
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
if(isset($_GET['id']) && isset($_GET['tb'])) {
  $id = $_GET['id'];
  if ($_GET['tb'] == 'poi') {
    $tb = 'tbl_poi';
    $key = 'poi_id';
  }
  if ($_GET['tb'] == 'product') {
    $tb = 'tbl_product';
    $key = 'pro_id';
  }
  if ($_GET['tb'] == 'food') {
    $tb = 'tbl_food';
    $key = 'fd_id';
  }
  if ($_GET['tb'] == 'package') {
    $tb = 'tbl_package';
    $key = 'pk_id';
  }
  if ($_GET['tb'] == 'admin') {
    $tb = 'tbl_admin';
    $key = 'admin_id';
  }
  $sql = "DELETE FROM $tb WHERE $key = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("i",$id);
  $stmt->execute();

}
$back = $_GET['back'];
echo '<meta http-equiv="refresh" content="0;url='.$back.'.php">';
$con->close();

 ?>
