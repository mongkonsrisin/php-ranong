<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_slider WHERE sld_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>
<div class="container">
  <h3 class="text-center">แก้ไขภาพหน้าหลัก</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sld_poiid = trim($_POST['sld_poiid']);

    if(empty($sld_poiid)) {
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
      $sql = "UPDATE tbl_slider SET sld_poiid=? WHERE sld_id=?";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("ii",$sld_poiid,$id);
      $stmt->execute();



      //Upload image.
      if(!empty($_FILES['sld_file']['tmp_name'])) {
        $path = "../assets/img/slide/";
        $path = $path . $id . '.png';
        unlink($path);
        file_put_contents($path,file_get_contents($_FILES['sld_file']['tmp_name']));
        
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
          window.location.href = 'allslider.php';
        });
      }, 100);</script>";


    }
  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
      

       
        <div class="form-group">
          <label for="sld_poiid"><strong>สถานที่</strong></label>
          <select class="form-control" id="sld_poiid" name="sld_poiid">
           	

            <?php
              $sql2 = "SELECT * FROM tbl_poi p LEFT JOIN tbl_category c ON p.poi_cat = c.cat_id ORDER BY poi_cat ASC , poi_name ASC ";
              $stmt2 = $con->prepare($sql2);
              $stmt2->execute();
              $result2 = $stmt2->get_result();
				
              while($row2 = $result2->fetch_assoc()) {
                $selected = '';
                if ($row2['poi_id'] == $row['sld_poiid']) {
                  $selected = ' selected';
                }
            ?>
            <option value="<?php echo $row2['poi_id']?>" <?php echo $selected ?>><?php echo $row2['cat_name']?> -  <?php echo $row2['poi_name']?></option>
            <?php } ?>
          </select>
      </div>

      <div class="form-group">
        <label for="sld_file"><strong>รูปภาพ</strong></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="sld_file" name="sld_file" accept="image/png">
          <label class="custom-file-label" for="sld_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="../assets/img/slide/<?php echo $row['sld_id'] ?>.png?cache=none" class="img-fluid">
      </div>
      <div class="text-right mt-5">
      <a href="editslider.php?id=<?php echo $row['sld_id'] ?>" class="btn btn-info full-width-on-mobile">
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
$("#sld_file").change(function() {
  readURL(this);
});
</script>
<?php require("template/footer.php") ?>
