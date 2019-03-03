<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<div class="container">
  <h3 class="text-center">เพิ่มห้องพัก</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

 
    $rm_poiid = trim($_POST['rm_poiid']);
    $rm_maxpeople = trim($_POST['rm_maxpeople']);
    $rm_price = trim($_POST['rm_price']);
    $rm_size = trim($_POST['rm_size']);

    if(empty($rm_poiid) || empty($rm_maxpeople) || empty($rm_price) || empty($rm_size)) {
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
      $sql = "INSERT INTO tbl_room (rm_poiid,rm_maxpeople,rm_price,rm_size) VALUES(?,?,?,?)";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("iiis",$rm_poiid,$rm_maxpeople,$rm_price,$rm_size);
      $stmt->execute();

     

      echo "<script>setTimeout(function () {
        swal({
          title: 'แจ้งเตือน',
          text: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
          type: 'success',
          closeOnCancel: false,
          allowOutsideClick: false
        },
        function(){
          window.location.href = 'allbed.php';
        });
      }, 100);</script>";
    }


  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
      <div class="form-group">
          <label for="rm_poiid"><strong>ชื่อที่พัก</strong></label>
          <select class="form-control" id="rm_poiid" name="rm_poiid">
            <option selected disabled>กรุณาเลือก...</option>
            <?php
              $sql2 = "SELECT * FROM tbl_poi WHERE poi_cat=1 ORDER BY poi_name ASC";
              $stmt2 = $con->prepare($sql2);
              $stmt2->execute();
              $result2 = $stmt2->get_result();
              while($row2 = $result2->fetch_assoc()) {
                $selected = '';
                if ($row['rm_poiid'] == $row2['poi_id']) {
                  $selected = ' selected';
                }
            ?>
            <option value="<?php echo $row2['poi_id']?>" <?php echo $selected; ?>><?php echo $row2['poi_name']?></option>
            <?php } ?>
          </select>
      </div>
        
        <div class="form-group">
            <label for="rm_maxpeople"><strong>จำนวนคนเข้าพักสูงสุด <sup class="text-danger font-weight-bold">*</sup></strong></label>
            <input type="text" class="form-control" value="<?php if(isset($_POST['rm_maxpeople'])) {echo $_POST['rm_maxpeople'];}?>"  id="rm_maxpeople" name="rm_maxpeople" autofocus onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='';}">
            </div>
        <div class="form-group">
          <label for="rm_price"><strong>ราคา <sup class="text-danger font-weight-bold">*</sup></strong></label>
          <input type="text" class="form-control" id="rm_price" value="<?php if(isset($_POST['rm_price'])) { echo $_POST['rm_price']; }?>" name="rm_price" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='';}">
        </div>
        <div class="form-group">
          <label for="rm_size"><strong>ขนาดเตียง</strong></label>
          <select class="form-control" id="rm_size" name="rm_size">
            <option selected disabled>กรุณาเลือก...</option>
              <option value="s">ห้องขนาดเล็ก (S)</option>
              <option value="m">ห้องขนาดกลาง (M)</option>
              <option value="l">ห้องขนาดใหญ่ (L)</option>
          </select>
      </div>
      
      <div class="text-right mt-5">
        <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
      </div>
      
    </div>
  </form>
</div>

<?php require("template/footer.php") ?>
