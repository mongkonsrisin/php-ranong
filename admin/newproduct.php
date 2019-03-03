<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<div class="container">
  <h3 class="text-center">เพิ่มสินค้า</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pro_name = trim($_POST['pro_name']);
    $pro_description = trim($_POST['pro_description']);
    $pro_price = trim($_POST['pro_price']);
    $pro_poiid = trim($_POST['pro_poiid']);
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
      //okay.
      $sql = "INSERT INTO tbl_product(pro_name,pro_description,pro_price,pro_poiid,pro_cert) VALUES(?,?,?,?,?)";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("ssiii",$pro_name,$pro_description,$pro_price,$pro_poiid,$pro_cert);
      $stmt->execute();

      $last_id = $con->insert_id;

        if(!empty($_FILES['pro_file']['tmp_name'])) {
        $path1 = "../assets/img/otop/product/$pro_poiid/";
        $path = $path1 . $last_id . '.png';
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
          text: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
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
          <input type="text" class="form-control" id="pro_name" name="pro_name" value="<?php if(isset($_POST['pro_name'])) { echo $_POST['pro_name']; }?>" autofocus>
        </div>
        <div class="form-group">
          <label for="pro_description"><strong>คำอธิบาย <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <textarea class="form-control" rows="8" id="pro_description" name="pro_description" style="resize:none"><?php if(isset($_POST['pro_description'])) { echo $_POST['pro_description']; }?></textarea>
        </div>
        <div class="form-group">
          <label for="pro_price"><strong>ราคา <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <input type="text" class="form-control" value="" min="0" id="pro_price" value="<?php if(isset($_POST['pro_price'])) { echo $_POST['pro_price']; }?>" name="pro_price" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='';}">
        </div>
        <div class="form-group">
          <label for="pro_poiid"><strong>สถานที่ <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <select class="form-control" id="pro_poiid" name="pro_poiid">
            <option selected disabled>กรุณาเลือก...</option>
            <?php
              $sql2 = "SELECT * FROM tbl_poi WHERE poi_cat=4 ORDER BY poi_name ASC";
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
        <label for="pro_cert"><strong>ใบรับรองสินค้า <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="pro_cert" name="pro_cert" value="1">
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
