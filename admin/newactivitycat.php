<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<div class="container">
  <h3 class="text-center">เพิ่มประเภทกิจกรรม</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $act_name = trim($_POST['act_name']);


    if (empty($act_name)) {
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
      $sql_insert = "INSERT INTO tbl_activity_icon (act_name) VALUES (?)";
          $stmt_insert = $con->prepare($sql_insert);
          $stmt_insert->bind_param("s",
          $act_name);
          $stmt_insert->execute();

          $last_id = $con->insert_id;
  //Upload image.
        $path = "../assets/img/package/icon/";
        $path = $path . $last_id . '.png';
        file_put_contents($path,file_get_contents($_FILES['act_file']['tmp_name']));
        


          echo "<script>setTimeout(function () {
            swal({
              title: 'แจ้งเตือน',
              text: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
              type: 'success',
              closeOnCancel: false,
              allowOutsideClick: false
            },
            function(){
              window.location.href = 'allactivitycat.php';
            });
          }, 100);</script>";
        }

      }      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="card bg-light border-dark mb-3">
          <div class="card-body">
            <div class="form-group">
              <label for="act_name"><strong>ชื่อประเภทกิจกรรม <sup class="text-danger font-weight-bold">*</sup></strong></label>
              <input type="text" class="form-control" value="<?php if(isset($_POST['act_name'])) {echo $_POST['act_name'];}?>"  id="act_name" name="act_name" autofocus>
            </div>
            <div class="form-group">
        <label for="act_file"><strong>รูปภาพ</strong></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="act_file" name="act_file" accept="image/png">
          <label class="custom-file-label" for="act_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="assets/img/no_image.jpg" class="img-fluid mt-3">
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
$("#act_file").change(function() {
  readURL(this);
});
</script>
            
        
          
    <?php require("template/footer.php") ?>
