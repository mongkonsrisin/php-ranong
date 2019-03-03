<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<div class="container">
  <h3 class="text-center">เพิ่มภาพหน้าหลัก</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sld_poiid = trim($_POST['sld_poiid']);
    if(empty($sld_poiid)  || empty($_FILES['sld_file'])) {
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
		$sql2 = "SELECT poi_name FROM tbl_poi where poi_id=$sld_poiid";
		$stmt2 = $con->prepare($sql2);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		$row2 = $result2->fetch_assoc();
		$sld_name=$row2["poi_name"];
		$sql = "INSERT INTO tbl_slider(sld_poiid, sld_name) VALUES(?, ?)";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("is",$sld_poiid, $sld_name);
		$stmt->execute();
		$last_id = $con->insert_id;
		//Upload image.
		$path = "../assets/img/slide/";
		$path = $path . $last_id . '.png';
		file_put_contents($path,file_get_contents($_FILES['sld_file']['tmp_name']));

		echo "<script>setTimeout(function () {
					swal({
							title: 'แจ้งเตือน',
							text: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
							type: 'success',
							closeOnCancel: false,
							allowOutsideClick: false
						},	function(){ window.location.href = 'allslider.php'; });
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
            <option selected disabled>กรุณาเลือก...</option>
            <?php
              $sql2 = "SELECT * FROM tbl_poi p LEFT JOIN tbl_category c ON p.poi_cat = c.cat_id ORDER BY poi_cat ASC , poi_name ASC ";
              $stmt2 = $con->prepare($sql2);
              $stmt2->execute();
              $result2 = $stmt2->get_result();
              while($row2 = $result2->fetch_assoc()) {
            ?>
            <option value="<?php echo $row2['poi_id']?>"><?php echo $row2['cat_name']?> -  <?php echo $row2['poi_name']?></option>
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
$("#sld_file").change(function() {
  readURL(this);
});
</script>
<?php require("template/footer.php") ?>