<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>

<div class="container">
  <h3 class="text-center">เพิ่มโปรแกรมท่องเที่ยว</h3>
  <?php
  if(!isset($_SESSION['route'])) {
    $_SESSION['route'] = array();

  }
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

  
    $pk_title = trim($_POST['pk_title']);
    $pk_description = trim($_POST['pk_description']);
    $pk_budget = trim($_POST['pk_budget']);
    $pk_days = trim($_POST['pk_days']);
    $pk_cat = trim($_POST['pk_cat']);


    $pk_route =   implode("|",$_SESSION['route']);


    if(empty($pk_title) || empty($pk_description) || empty($pk_budget) || empty($pk_days) ||  empty($pk_route)) {
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



$sql = "INSERT INTO tbl_package (pk_title,pk_description,pk_budget,pk_category,pk_route,pk_days) VALUES(?,?,?,?,?,?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssiisi",$pk_title,$pk_description,$pk_budget,$pk_cat,$pk_route,$pk_days);
$stmt->execute();
$last_id = $con->insert_id;
//Upload image.
if(!empty($_FILES['program_file']['tmp_name'])) 
{
  $path1 = "../assets/img/package/$last_id/";
  $path = $path1 ."preview". $last_id . '.png';
  if (file_exists($path)){
  unlink($path);
  }
  if (!is_dir($path1)){
    @mkdir($path1);

  }
  file_put_contents($path,file_get_contents($_FILES['program_file']['tmp_name']));
  
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
              window.location.href = 'allprogram.php';
            });
          }, 100);</script>";
    }





  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
  
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
        <div class="form-group">
          <label for="pk_title"><strong>ชื่อโปรแกรม</strong></label>
          <input type="text" class="form-control" value="" id="pk_title" name="pk_title" autofocus>
        </div>
        <div class="form-group">
          <label for="pk_description"><strong>คำอธิบาย</strong></label>
          <textarea class="form-control" rows="8" id="pk_description" name="pk_description" style="resize:none"></textarea>
        </div>
        <div class="form-group">
          <label for="pk_budget"><strong>งบประมาณ</strong></label>
          <input type="text" class="form-control" value="" min="0" id="pk_budget" name="pk_budget" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='';}">
        </div>
        <div class="form-group">
          <label for="pk_days"><strong>จำนวนวัน</strong></label>
          <input type="text" class="form-control" value="" min="0" id="pk_days" name="pk_days" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='';}">
        </div>
        <div class="form-group">
          <label for="pk_cat"><strong>ประเภท</strong></label>
          <select class="form-control" id="pk_cat" name="pk_cat">
            <option value="0">เชิงนิเวศ+สุขภาพ</option>
            <option value="1">เชิงนิเวศ</option>
            <option value="2">เชิงสุขภาพ</option>
          </select>
        </div>
        <div class="form-group">
          <label for="pk_route"><strong>สถานที่</strong></label>
          <div class="row">
            <div class="col-lg-10">
              <select class="form-control" id="pk_route" name="pk_route">
                <option selected disabled>กรุณาเลือก...</option>
                <?php
                $sql3 = "SELECT * FROM tbl_poi p LEFT JOIN tbl_category c ON p.poi_cat = c.cat_id ORDER BY poi_cat , poi_name ASC";
                $stmt3 = $con->prepare($sql3);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                while($row3 = $result3->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $row3['poi_id']?>"><?php echo $row3['cat_name'] ?> - <?php echo $row3['poi_name']?> <span class="text-danger" style="color:red !important"></span></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-lg-2">
              <button class="btn btn-primary btn-block" type="button" onclick="addRoute()"><i class="fas fa-plus"></i> เพิ่มสถานที่นี้</button>
            </div>
          </div>
          <div class="mt-3" id="route_detail">

            <ol onload="showRoute()">
              <!-- ajax -->
            </ol>
            <a href="#" class="text-danger" onclick="clearRoute()"><i class="fas fa-trash"></i> ลบทั้งหมด</a>
          </div>
          <div class="form-group">
        <label for="program_file"><strong>รูปภาพ</strong></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="program_file" name="program_file" accept="image/png">
          <label class="custom-file-label" for="program_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="assets/img/no_image.jpg" class="img-fluid mt-3">
      </div>
        </div>

        <div class="text-right mt-5">
          <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
        </div>
      </div>
    </form>
  </div>




  <script>



  function addRoute() {
    var poi_id = $('#pk_route').val();
    $.ajax({
      url: "ajax/add_route.php",
      data: ({ id: poi_id }),
      success: function() {
        showRoute();

      }
    });

  }

  function clearRoute() {
    $.ajax({
      url: "ajax/clear_route.php"
    });
    showRoute();

  }

  function showRoute() {
    $('ol').empty();
    $.ajax({
      url: "ajax/get_route.php",
      dataType: "json",
      success: function(json){
        $.each(json, function(index, value) {
          $('ol').append(
            $('<li>').append("<strong>" + value.cat +"</strong>  - " + value.name + " <a href='#' onclick='del(\"" +index+"\",\""+value.name + "\")' class='text-danger'><i class='fas fa-trash'></i> ลบ</a>"));
          });
        }
      });
    }
    showRoute();
 

 function del(index,poi_name){
 swal('แจ้งเตือน','ลบ ' +poi_name+ ' เรียบร้อย','success');
  $.ajax({
      url: "ajax/del_route.php",
      dataType: "json",
      data: ({ id: index }),
      success: function(json){
        $('ol').empty();
        $.each(json, function(index, value) {
          $('ol').append(
            $('<li>').append("<strong>" + value.cat +"</strong>  - " + value.name + " <a href='#' onclick='del(\"" +index+"\",\""+value.name + "\")' class='text-danger'><i class='fas fa-trash'></i> ลบ</a>"));
          });
        }
      })
  
 }

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
$("#program_file").change(function() {
  readURL(this);
});
  </script>

  <?php require("template/footer.php") ?>
