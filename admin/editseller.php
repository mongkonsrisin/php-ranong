<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_poi WHERE poi_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>
<div class="container">
  <h3 class="text-center">แก้ไขผู้ประกอบการ</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

      //Upload image.
      if(!empty($_FILES['sel_file']['tmp_name'])) {
        $path = "../assets/img/otop/";
        $path = $path . $id . '.png';
        @unlink($path);
        // move_uploaded_file($_FILES['sel_file']['tmp_name'], $path);
        file_put_contents($path,file_get_contents($_FILES['sel_file']['tmp_name']));
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
          window.location.href = 'allseller.php';
        });
      }, 100);</script>";


    }
  
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
      <div class="form-group">
          <label for="poi_name"><strong>ชื่อร้านค้า</strong></label>
          <input type="text" class="form-control" value="<?php echo $row['poi_name']?>" id="poi_name" name="poi_name" autofocus disabled>
        </div>
      <div class="form-group">
        <label for="sel_file"><strong>รูปภาพ</strong></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="sel_file" name="sel_file" accept="image/png">
          <label class="custom-file-label" for="sel_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="../assets/img/otop/<?php echo $row['poi_id'] ?>.png?cache=none" class="img-fluid">
      </div>
      <div class="text-right mt-5">
      <a href="editseller.php?id=<?php echo $row['poi_id'] ?>" class="btn btn-info full-width-on-mobile">
          <span class=""> <i class="fas fa-sync-alt"></i></span> รีเซ็ต
        </a>
        <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
      </div>
    </div>
  </form>
</div>
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    if (input.files[0].type!='image/png') {
    swal({
        title: 'ข้อผิดพลาด',
        text: 'กรุณาเลือกเฉพาะรูปไฟล์ PNG เท่านั้น',
        type: 'error',
        closeOnCancel: false,
        allowOutsideClick: false
    });
    }
    else
    {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    }
  }
  }
$("#sel_file").change(function() {
  readURL(this);
});
</script>
<?php require("template/footer.php") ?>
