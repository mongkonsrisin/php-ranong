<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM tbl_product WHERE pro_id=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("i",$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $pro_poiid = $row['pro_poiid'];
?>
<div class="container">
  <h3 class="text-center">แก้ไขสินค้า</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pro_name = trim($_POST['pro_name']);
    $pro_description = trim($_POST['pro_description']);
    $pro_price = trim($_POST['pro_price']);
    $pro_cert = trim($_POST['pro_cert']);




    if(empty($pro_name) || empty($pro_description) || empty($pro_price) || empty($pro_poiid) || empty($_FILES['pro_file'])) {
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

          $sql2 = "UPDATE tbl_product SET pro_name=? , pro_description=? , pro_price=? , pro_cert=? WHERE pro_id=?";
          $stmt2 = $con->prepare($sql2);
          $stmt2->bind_param("ssiii",$pro_name,$pro_description,$pro_price,$pro_cert,$id);
          $stmt2->execute();



          if(!empty($_FILES['pro_file']['tmp_name'])) {
          $path1 = "../assets/img/otop/product/$pro_poiid/";
          $path = $path1 . $id . '.png';
          if (file_exists($path)){
          unlink($path);
          }
          if (!is_dir($path1)){
            @mkdir($path1);

          }
          file_put_contents($path,file_get_contents($_FILES['pro_file']['tmp_name']));
          
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
              window.location.href = 'allproduct.php';
            });
          }, 100);</script>";
    }

  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
        <div class="form-group">
          <label for="pro_name"><strong>ชื่อสินค้า <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <input type="text" class="form-control" value="<?php echo $row['pro_name']?>" id="pro_name" name="pro_name" autofocus>
        </div>
        <div class="form-group">
          <label for="pro_description"><strong>คำอธิบาย <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <textarea class="form-control" rows="8" id="pro_description" name="pro_description" style="resize:none"><?php echo $row['pro_description']?></textarea>
        </div>
        <div class="form-group">
          <label for="pro_price"><strong>ราคา <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <input type="text" class="form-control" value="<?php echo $row['pro_price']?>" min="0" id="pro_price" name="pro_price" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['pro_price']?>';}">
        </div>
        <div class="form-group">
          <label for="pro_poiid"><strong>สถานที่ <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <select class="form-control" id="pro_poiid" name="pro_poiid">
            <option selected disabled>กรุณาเลือก...</option>
            <?php
              $sql3 = "SELECT * FROM tbl_poi WHERE poi_cat=4 ORDER BY poi_name ASC";
              $stmt3 = $con->prepare($sql3);
              $stmt3->execute();
              $result3 = $stmt3->get_result();
              while($row3 = $result3->fetch_assoc()) {
                $selected = '';
                if ($row['pro_poiid'] == $row3['poi_id']) {
                  $selected = ' selected';
                }
            ?>
            <option value="<?php echo $row3['poi_id']?>" <?php echo $selected; ?>><?php echo $row3['poi_name']?></option>
            <?php } ?>
          </select>
      </div>
      <div class="form-group">
        <label for="pro_cert"><strong>ใบรับรองสินค้า <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <div class="form-check">
          <input type="checkbox" <?php if($row['pro_cert'] == 1) {echo 'checked'; }?> class="form-check-input" id="pro_cert" name="pro_cert" value="1">
          <label class="form-check-label" for="pro_cert">มีใบรับรอง</label>
        </div>
      </div>
      <div class="form-group">
        <label for="pro_file"><strong>รูปสินค้า <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="pro_file" name="pro_file" accept="image/png">
          <label class="custom-file-label" for="pro_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="../assets/img/otop/product/<?=$row['pro_poiid'] ?>/<?=$row['pro_id'] ?>.png?cache=none" class="img-fluid">
      </div>
      <div class="text-right mt-5">
      <a href="editproduct.php?id=<?php echo $row['pro_id'] ?>" class="btn btn-info full-width-on-mobile">
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
$("#pro_file").change(function() {
  readURL(this);
});
</script>
<?php require("template/footer.php") ?>
