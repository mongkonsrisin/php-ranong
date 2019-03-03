<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_room WHERE rm_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<div class="container">
  <h3 class="text-center">แก้ไขห้องพัก</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $rm_poiid = trim($_POST['rm_poiid']);
    $rm_maxpeople = trim($_POST['rm_maxpeople']);
    $rm_price = trim($_POST['rm_price']);
    $rm_size = trim($_POST['rm_size']);

    if(empty($rm_poiid) || empty($rm_maxpeople) || empty($rm_price) || empty($rm_size)) {
      //Empty fields.
      echo "<script>setTimeout(function () {
      swal({
      title: 'ข้อผิดพลาด',
      text: 'กรุณากรอกข้อมูลให้ครบ',
      type: 'error',
      closeOnCancel: false,
      allowOutsideClick: false
      });
      }, 100);</script>";

    } else {
      //okay.
      $sql = "UPDATE tbl_room SET rm_poiid=?,rm_maxpeople=?,rm_price=?,rm_size=? WHERE rm_id=?";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("iiisi",$rm_poiid,$rm_maxpeople,$rm_price,$rm_size,$id);
      $stmt->execute();

      if(!empty($_FILES['fd_file']['tmp_name'])) {
        $path1 = "../assets/img/poi/s/$rm_poiid/";
        $path = $path1 . $id . '.png';
        if (file_exists($path)){
        unlink($path);
        }
        if (!is_dir($path1)){
          @mkdir($path1);

        }
        
        move_uploaded_file($_FILES['fd_file']['tmp_name'], $path);
    }


      echo "<script>setTimeout(function () {
        swal({
          title: 'แจ้งเตือน',
          text: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
          type: 'success',
          closeOnCancel: false,
          allowOutsideClick: false
        },
        function(){
          window.location.href = 'allbed.php';
        });
      }, 100);</script>";


    }
  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">

      <div class="form-group">
          <label for="rm_poiid"><strong>ชื่อที่พัก</strong> <sup class="text-danger font-weight-bold">*</sup></label>
          <select class="form-control" id="rm_poiid" name="rm_poiid">
            
            <?php
              $sql2 = "SELECT * FROM tbl_poi WHERE poi_cat=1 AND poi_id = '".$row['rm_poiid']."' ORDER BY poi_name ASC";
              $stmt2 = $con->prepare($sql2);
              $stmt2->execute();
              $result2 = $stmt2->get_result();
              while($row2 = $result2->fetch_assoc()) {
            ?>
            <option value="<?php echo $row2['poi_id']?>"><?php echo $row2['poi_name']?></option>
            <?php } ?>
          </select>
      </div>

      <div class="form-group">
            <label for="rm_maxpeople"><strong>จำนวนคนเข้าพักสูงสุด <sup class="text-danger font-weight-bold">*</sup></strong></label>
            <input type="text" class="form-control" value="<?php echo $row['rm_maxpeople']?>"  id="rm_maxpeople" name="rm_maxpeople" autofocus onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['rm_maxpeople']?>';}">
            </div>

        <div class="form-group">
          <label for="fd_price"><strong>ราคา</strong> <sup class="text-danger font-weight-bold">*</sup></label>
          <input type="text" class="form-control" value="<?php echo $row['rm_price']?>" min="0" id="rm_price" name="rm_price" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['rm_price']?>';}">
        </div>
        

        <div class="form-group">
          <label for="rm_size"><strong>ขนาดเตียง</strong> <sup class="text-danger font-weight-bold">*</sup></label>
          <select class="form-control" id="rm_size" name="rm_size" >
            
              <option value="s" <?=(($row['rm_size']=='s')?"selected":"")?>>ห้องขนาดเล็ก (S)</option>
              <option value="m" <?=(($row['rm_size']=='m')?"selected":"")?>>ห้องขนาดกลาง (M)</option>
              <option value="l" <?=(($row['rm_size']=='l')?"selected":"")?>>ห้องขนาดใหญ่ (L)</option>
          </select>
      </div>

      <div class="text-right mt-5">
      <a href="editbed.php?id=<?php echo $row['rm_id'] ?>" class="btn btn-info full-width-on-mobile">
          <span class=""> <i class="fas fa-sync-alt"></i></span> รีเซ็ต
        </a>
        <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
      </div>
    </div>
  </form>
</div>

<?php require("template/footer.php") ?>
