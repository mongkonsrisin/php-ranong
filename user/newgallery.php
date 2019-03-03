<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
$id = $_SESSION['id'];
?>
<div class="container">
  <h3 class="text-center">เพิ่มแกลลอรี่ภาพ</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


   


    if (empty($_FILES['gal_file']['tmp_name'])) {
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
     
     
  //Upload image.
        $last_id = $con->insert_id;

        if(!empty($_FILES['gal_file']['tmp_name'])) {
        $path1 = "../assets/img/photo/$id/";
        $next = $id.date('Ymdhis');
        $path = $path1 . $next . $last_id . '.png';
        if (file_exists($path)){
        unlink($path);
        }
        if (!is_dir($path1)){
          @mkdir($path1);

        }
        file_put_contents($path,file_get_contents($_FILES['gal_file']['tmp_name']));
        
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
              window.location.href = 'gallerypoi.php';
            });
          }, 100);</script>";
        }

      }      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="card bg-light border-dark mb-3">
          <div class="card-body">
          <div class="form-group">
          <label for="gal_file"><strong>รูปแกลลอรี่ </strong></label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="gal_file" name="gal_file">
            <label class="custom-file-label" for="gal_file">เลือกรูป</label>
          </div>
          <br><br>
          <img id="preview" src="assets/img/no_image.jpg" class="img-fluid">
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
$("#gal_file").change(function() {
  readURL(this);
});
</script>
            
        
          
    <?php require("template/footer.php") ?>
