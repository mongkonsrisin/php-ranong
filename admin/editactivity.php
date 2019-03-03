<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_activity WHERE act_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<div class="container">
  <h3 class="text-center">แก้ไขกิจกรรม</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


        $act_name = trim($_POST['act_name']);
        $act_detail = trim($_POST['act_detail']);
        $act_time = trim($_POST['act_time']);
        $act_icon = trim($_POST['act_icon']);


        if (empty($act_name) || empty($act_detail) || empty($act_time) || empty($act_icon)) {
          //Empty fields.
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
        $sql_update = "UPDATE tbl_activity  SET act_name=?,act_detail=?,act_time=?,act_icon=? WHERE act_id=?";


              $stmt_update = $con->prepare($sql_update);



              $stmt_update->bind_param("ssssi",
              $act_name,$act_detail,$act_time,$act_icon,$id);
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
                  window.location.href = 'allactivity.php';
                });
              }, 100);</script>";
            }

}
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="card bg-light border-dark mb-3">
    <div class="card-body">
      <div class="form-group">
        <label for="act_name"><strong>ชื่อกิจกรรม <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control" value="<?php echo $row['act_name']?>" id="act_name" name="act_name" autofocus>
      </div>
      <div class="form-group">
        <label for="act_detail"><strong>รายละเอียดกิจกรรม <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <textarea class="form-control" rows="8" id="act_detail" name="act_detail" style="resize:none"><?php echo $row['act_detail']?></textarea>
      </div>
      <div class="form-group">
        <label for="act_time"><strong>ระยะเวลา <sup class="text-danger font-weight-bold">*</sup><small class="text-danger">( นาที )</small></strong></label>
        <input type="text" class="form-control" value="<?php echo $row['act_time']?>" id="act_time" name="act_time" autofocus onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['act_time']?>';}">
      </div>
      <div class="form-group">
        <label for="act_icon"><strong>ประเภทกิจกรรม <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <select class="form-control" id="act_icon" name="act_icon">
          <?php
          $sql_act = "SELECT * FROM tbl_activity_icon ORDER BY act_name ASC";
          $stmt_act = $con->prepare($sql_act);
          $stmt_act->execute();
          $result_act= $stmt_act->get_result();
          while($row_act = $result_act->fetch_assoc()) {
            
            $sel = ($row['act_icon']==$row_act['act_id'])?'selected':'';
            ?>
            <option value="<?php echo $row_act['act_id']?>" <?=$sel?>><?php echo $row_act['act_name']?></option>
          <?php } ?>
        </select>
      </div>
      <div class="text-right mt-5">
      <a href="editactivity.php?id=<?php echo $row['act_id'] ?>" class="btn btn-info full-width-on-mobile">
          <span class=""> <i class="fas fa-sync-alt"></i></span> รีเซ็ต
        </a>
        <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
      </div>
    </div>
  </form>
</div>
<?php require("template/footer.php") ?>
 