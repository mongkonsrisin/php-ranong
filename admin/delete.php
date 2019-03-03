<?php
require('template/header.php');
require('config/dbconfig.php');
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
if(isset($_GET['id']) && isset($_GET['tb'])) {
  $id = $_GET['id'];
  $nodelete = 0;
  
  if ($_GET['tb'] == 'poi') {
    $tb = 'tbl_poi';
    $key = 'poi_id';
    @unlink('../assets/img/poi/s/'.$_GET['id'].'.png');
    @unlink('../assets/img/poi/m/'.$_GET['id'].'.png');
    @unlink('../assets/img/banner/'.$_GET['poiid'].'/left'.$_GET['id'].'.png');
    @unlink('../assets/img/banner/'.$_GET['poiid'].'/slide'.$_GET['id'].'.png');
    $nodelete+=checkpackage($id);
    $nodelete+=checkroom($id);
    $nodelete+=checkfood($id);
    $nodelete+=checkproduct($id);
  }
  if ($_GET['tb'] == 'product') {
    $tb = 'tbl_product';
    $key = 'pro_id';
    @unlink('../assets/img/otop/product/'.$_GET['poiid'].'/'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'food') {
    $tb = 'tbl_food';
    $key = 'fd_id';
    @unlink('../assets/img/food/'.$_GET['poiid'].'/'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'package') {
    $tb = 'tbl_package';
    $key = 'pk_id';
    @unlink('../assets/img/package/'.$_GET['pkid'].'/preview'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'admin') {
    $tb = 'tbl_admin';
    $key = 'admin_id';
    @unlink('../assets/img/user/'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'activity') {
    $tb = 'tbl_activity';
    $key = 'act_id';
  }
   if ($_GET['tb'] == 'icon') {
    $tb = 'tbl_activity_icon';
    $key = 'act_id';
    @unlink('../assets/img/package/icon/'.$_GET['id'].'.png');
    $nodelete+=checkactivityicon($id);
  }
    if ($_GET['tb'] == 'slider') {
    $tb = 'tbl_slider';
    $key = 'sld_id';
    @unlink('../assets/img/slide/'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'bed') {
    $tb = 'tbl_room';
    $key = 'rm_id';
    @unlink('../assets/img/poi/s/'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'pin') {
    $tb = 'tbl_pin';
    $key = 'pin_id';
    @unlink('../assets/img/pin/pin'.$_GET['id'].'.png');
    $nodelete+=checkpin($id);
  }
  if ($_GET['tb'] == 'seller') {
    $tb = 'tbl_poi';
    $key = 'poi_id';
    @unlink('../assets/img/otop/'.$_GET['id'].'.png');
  }
$cat = trim($_GET['cat']);
$back = $_GET['back'];
  if($nodelete == 0){
     $sql = "DELETE FROM $tb WHERE $key = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $con->close();
    echo '<meta http-equiv="refresh" content="0;url='.$back.'.php?cat='.$cat.'">';
    

  }
  else {
    echo "<script>alertswal('ไม่สามารถลบข้อมูลได้ เนื่องจากถูกใช้งานในส่วนอื่นอยู่ ณ ขณะนี้');</script>";
    echo '<meta http-equiv="refresh" content="1.5;url='.$back.'.php?cat='.$cat.'">';
  }
 
}




 ?>
