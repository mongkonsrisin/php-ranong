<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
if( $_SESSION['role'] != 'admin') {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit();
}
?>
<div class="container">
  <h3 class="text-center">เพิ่มผู้ดูแล</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $admin_user = trim($_POST['admin_user']);
    $admin_title= trim($_POST['admin_title']);
    $admin_name = trim($_POST['admin_name']);
    $admin_lname = trim($_POST['admin_lname']);
    $admin_pass = trim($_POST['admin_pass']);
    $admin_cpass = trim($_POST['admin_cpass']);

    if (empty($admin_user) || empty($admin_pass) || empty($admin_cpass)) {
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
      $sql_insert = "INSERT INTO tbl_admin (admin_user,admin_pass,admin_title,admin_name,admin_lname) VALUES (?,?,?,?,?)";
          $stmt_insert = $con->prepare($sql_insert);
          $stmt_insert->bind_param("ssiss",
          $admin_user,md5($admin_pass),$admin_title,$admin_name,$admin_lname);
          $stmt_insert->execute();

          //Upload image.

        $last_id = $con->insert_id;

        if(!empty($_FILES['user_file']['tmp_name'])) {
        $path1 = "../assets/img/user/";
        $path = $path1 . $last_id . '.png';
        if (file_exists($path)){
        unlink($path);
        }
        if (!is_dir($path1)){
          @mkdir($path1);

        }
        file_put_contents($path,file_get_contents($_FILES['user_file']['tmp_name']));
    }



          echo "<script>setTimeout(function () {
            swal({
              title: 'แจ้งเตือน',
              text: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
              type: 'success',
              closeOnCancel: false,
              allowOutsideClick: false
            },
            function(){
              window.location.href = 'alluser.php';
            });
          }, 100);</script>";
        }

      }
      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="card bg-light border-dark mb-3">
          <div class="card-body">
            <div class="form-group">
              <label for="admin_user"><strong>Username <sup class="text-danger font-weight-bold">*</sup></strong></label>
              <input type="text" class="form-control" value="<?php if(isset($_POST['admin_user'])) {echo $_POST['admin_user'];}?>"  id="admin_user" name="admin_user" autofocus>
            </div>
            
            <div class="form-group">
              <label for="admin_title"><strong>คำนำหน้า <sup class="text-danger font-weight-bold">*</sup></strong></label>
              <select class="form-control" id="admin_title" name="admin_title">
                  <option value="0">นาย</option>
                  <option value="1">นาง</option>
                  <option value="2">นางสาว</option>
              </select>
            </div>




            <div class="form-group">
              <label for="admin_name"><strong>ชื่อ <sup class="text-danger font-weight-bold">*</sup></strong></label>
              <input type="text" class="form-control" value="<?php if(isset($_POST['admin_name'])) {echo $_POST['admin_name'];}?>"  id="admin_name" name="admin_name" autofocus>
            </div>
            <div class="form-group">
              <label for="admin_lname"><strong>นามสกุล <sup class="text-danger font-weight-bold">*</sup></strong></label>
              <input type="text" class="form-control" value="<?php if(isset($_POST['admin_lname'])) {echo $_POST['admin_lname'];}?>"  id="admin_lname" name="admin_lname" autofocus>
            </div>
            <div class="form-group">
              <label for="admin_pass"><strong>รหัสผ่าน <sup class="text-danger font-weight-bold">*</sup></strong></label>
              <input type="password" class="form-control" value="<?php if(isset($_POST['admin_pass'])) {echo $_POST['admin_pass'];}?>"  id="admin_pass" name="admin_pass" autofocus>
            </div>
            <div class="form-group">
                <label for="admin_cpass"><strong>ยืนยันรหัสผ่าน <sup class="text-danger font-weight-bold">*</sup></strong></label>
                <input type="password" class="form-control" value="<?php echo $row['admin_pass']?>" id="admin_cpass" name="admin_cpass" autofocus>
            </div>
            <div class="form-group">
              <label for="user_file"><strong>รูปภาพ <sup class="text-danger font-weight-bold">* กรุณาเลือกเฉพาะรูปไฟล์ PNG เท่านั้น</sup></strong></label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="user_file" name="user_file" accept="image/png">
                <label class="custom-file-label" for="user_file">เลือกรูป</label>
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
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      });
    </script>
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
    $("#user_file").change(function() {
      readURL(this);
    });
    </script>
    <?php require("template/footer.php") ?>
