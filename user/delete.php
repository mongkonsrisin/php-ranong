<?php
require('template/header.php');
require('config/dbconfig.php');
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
  //delete.php?id=XXX&tb=XXX&back=XXX&poiid=XXX
 //Check poi
if($_GET['poiid'] != $_SESSION['id']) {
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
  exit();
}
if(isset($_GET['id']) && isset($_GET['tb'])) {
  $id = $_GET['id'];
  $nodelete = 0;
  
  //Check category
if ($_GET['tb'] == 'product' && $_SESSION['cat'] == 4) {
    $tb = 'tbl_product';
    $key = 'pro_id';
    @unlink('../assets/img/otop/product/'.$_GET['poiid'].'/'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'food' && $_SESSION['cat'] == 3) {
    $tb = 'tbl_food';
    $key = 'fd_id';
    @unlink('../assets/img/food/'.$_GET['poiid'].'/'.$_GET['id'].'.png');
  }
  if ($_GET['tb'] == 'bed' && $_SESSION['cat'] == 1) {
    $tb = 'tbl_room';
    $key = 'rm_id';
    @unlink('../assets/img/poi/s/'.$_GET['id'].'.png');
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
 
} else {
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
  exit();

}


 ?>
