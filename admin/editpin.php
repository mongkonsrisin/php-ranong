<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_pin WHERE pin_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<div class="container">
  <h3 class="text-center">แก้ไขหมุดสถานที่</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


        $pin_name = trim($_POST['pin_name']);
     


        if (empty($pin_name)) {
          //Empty fields.
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

        }
        else {
          //Okay.
        $sql_update = "UPDATE tbl_pin  SET pin_name=? WHERE pin_id=?";
              $stmt_update = $con->prepare($sql_update);
              $stmt_update->bind_param("si",$pin_name,$id);
              $stmt_update->execute();
 //Upload image.
            if(!empty($_FILES['pin_file']['tmp_name'])) {
              $path1 = "../assets/img/pin/";
              $path = $path1 . 'pin' .$id . '.png';
              if (file_exists($path)){
              unlink($path);
              }
              if (!is_dir($path1)){
                @mkdir($path1);

              }
              file_put_contents($path,file_get_contents($_FILES['pin_file']['tmp_name']));
             
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
                  window.location.href = 'allpin.php';
                });
              }, 100);</script>";
            }

}
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="card bg-light border-dark mb-3">
    <div class="card-body">
      <div class="form-group">
        <label for="pin_name"><strong>ชื่อหมุด <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control" value="<?php echo $row['pin_name']?>" id="pin_name" name="pin_name" autofocus>
      </div>
      <div class="form-group">
        <label for="pin_file"><strong>รูปภาพ</strong><br><small class="text-danger">ใช้ไฟล์รูปประเภท .png ขนาด 68x60 พื้นหลังโปร่งใส (Transparent)</small></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="pin_file" name="pin_file" accept="image/png">
          <label class="custom-file-label" for="pin_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="../assets/img/pin/pin<?php echo $row['pin_id'] ?>.png?cache=none" class="img-fluid">
      </div>
      <div class="text-right mt-5">
      <a href="editpin.php?id=<?php echo $row['pin_id'] ?>" class="btn btn-info full-width-on-mobile">
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
$("#pin_file").change(function() {
  readURL(this);
});
</script>
  
<?php require("template/footer.php") ?>
 