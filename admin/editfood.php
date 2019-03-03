<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_food WHERE fd_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<div class="container">
  <h3 class="text-center">แก้ไขอาหาร</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $fd_name = trim($_POST['fd_name']);
    $fd_price = trim($_POST['fd_price']);
    $fd_poiid = trim($_POST['fd_poiid']);

    if(empty($fd_name) || empty($fd_price) || empty($fd_poiid)) {
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
      $sql = "UPDATE tbl_food SET fd_name=?,fd_price=?,fd_poiid=? WHERE fd_id=?";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("sssi",$fd_name,$fd_price,$fd_poiid,$id);
      $stmt->execute();

      if(!empty($_FILES['fd_file']['tmp_name'])) {
        $path1 = "../assets/img/food/$fd_poiid/";
        $path = $path1 . $id . '.png';
        if (file_exists($path)){
        unlink($path);
        }
        if (!is_dir($path1)){
          @mkdir($path1);

        }
        file_put_contents($path,file_get_contents($_FILES['fd_file']['tmp_name']));
        
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
          window.location.href = 'allfood.php';
        });
      }, 100);</script>";


    }
  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
        <div class="form-group">
          <label for="fd_name"><strong>ชื่ออาหาร</strong></label>
          <input type="text" class="form-control" value="<?php echo $row['fd_name']?>" id="fd_name" name="fd_name" autofocus>
        </div>

        <div class="form-group">
          <label for="fd_price"><strong>ราคา</strong></label>
          <input type="text" class="form-control" value="<?php echo $row['fd_price']?>" min="0" id="fd_price" name="fd_price" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['fd_price']?>';}">
        </div>
        <div class="form-group">
          <label for="fd_poiid"><strong>สถานที่</strong></label>
          <select class="form-control" id="fd_poiid" name="fd_poiid">
            <option selected disabled>กรุณาเลือก...</option>
            <?php
              $sql2 = "SELECT * FROM tbl_poi WHERE poi_cat=3 ORDER BY poi_name ASC";
              $stmt2 = $con->prepare($sql2);
              $stmt2->execute();
              $result2 = $stmt2->get_result();
              while($row2 = $result2->fetch_assoc()) {
                $selected = '';
                if ($row['fd_poiid'] == $row2['poi_id']) {
                  $selected = ' selected';
                }
            ?>
            <option value="<?php echo $row2['poi_id']?>" <?php echo $selected; ?>><?php echo $row2['poi_name']?></option>
            <?php } ?>
          </select>
      </div>

      <div class="form-group">
        <label for="fd_file"><strong>รูปอาหาร</strong></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="fd_file" name="fd_file" accept="image/png">
          <label class="custom-file-label" for="fd_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="../assets/img/food/<?=$row['fd_poiid'] ?>/<?=$row['fd_id'] ?>.png?cache=none" class="img-fluid">
      
      </div>
      <div class="text-right mt-5">
      <a href="editfood.php?id=<?php echo $row['fd_id'] ?>" class="btn btn-info full-width-on-mobile">
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
$("#fd_file").change(function() {
  readURL(this);
});
</script>
<?php require("template/footer.php") ?>
