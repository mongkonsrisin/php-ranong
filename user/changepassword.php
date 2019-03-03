<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_SESSION['id'];
$sql = "SELECT * FROM tbl_poi WHERE poi_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<div class="container">
  <h3 class="text-center">เปลี่ยนรหัสผ่าน</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


        
        $admin_pass = trim($_POST['admin_pass']);
        $admin_cpass = trim($_POST['admin_cpass']);
        
        $id = $_SESSION['id'];
        if (empty($admin_pass) || empty($admin_cpass)) {
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
        else if ($admin_pass != $admin_cpass){
          echo "<script>setTimeout(function () {
            swal({
              title: 'ข้อผิดพลาด',
              text: 'รหัสผ่านไม่ตรงกัน',
              type: 'error',
              closeOnCancel: false,
              allowOutsideClick: false
            });
          }, 100);</script>";
        }
        else {
          //Okay.

        $sql_update = "UPDATE tbl_poi SET poi_password=? WHERE poi_id=?";


              $stmt_update = $con->prepare($sql_update);
              $stmt_update->bind_param("si",md5($admin_pass),$id);
              $stmt_update->execute();



              echo "<script>setTimeout(function () {
                swal({
                  title: 'แจ้งเตือน',
                  text: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                  type: 'success',
                  closeOnCancel: false,
                  allowOutsideClick: false
                },
                function(){
                  window.location.href = 'index.php';
                });
              }, 100);</script>";
            }

          }
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="card bg-light border-dark mb-3">
    <div class="card-body">
      <div class="form-group">
        <label for="admin_pass"><strong>รหัสผ่าน <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="password" class="form-control" id="admin_pass" name="admin_pass" autofocus>
      </div>

      <div class="form-group">
        <label for="admin_cpass"><strong>ยืนยันรหัสผ่าน <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="password" class="form-control" id="admin_cpass" name="admin_cpass" autofocus>
      </div>
   
      <div class="text-right mt-5">
        <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
      </div>
    </div>
  </form>
</div>
<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#poi_file").change(function() {
  readURL(this);
});






<?php require("template/footer.php") ?>
