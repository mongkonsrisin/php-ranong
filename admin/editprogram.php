<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = trim($_POST['id']); 
  $pk_title = trim($_POST['pk_title']);
  $pk_description = trim($_POST['pk_description']);
  $pk_budget = trim($_POST['pk_budget']);
  $pk_days = trim($_POST['pk_days']);
  $pro_poiid = trim($_POST['pro_poiid']);
  $pk_cat = trim($_POST['pk_cat']);
  $temp =   implode("|",$_SESSION['route']);

  // $sql = "UPDATE tbl_package (pk_title,pk_description,pk_budget,pk_category,pk_route) VALUES(?,?,?,?,?)";
  // $stmt = $con->prepare($sql);
  // $stmt->bind_param($pk_title,$pk_description,$pk_budget,$pk_cat,$pk_route);
  // $stmt->execute();

  $sql_update = "UPDATE tbl_package SET pk_title=?,pk_description=?,pk_budget=?,pk_days=?,pk_category=?,pk_route=? WHERE pk_id=?";
  $stmt_update = $con->prepare($sql_update);
  $stmt_update->bind_param("ssiiisi",$pk_title,$pk_description,$pk_budget,$pk_days,$pk_cat,$temp,$id);
  $stmt_update->execute();


  if(!empty($_FILES['program_file']['tmp_name'])) {
    $path1 = "../assets/img/package/$id/";
    $path = $path1 ."preview". $id . '.png';
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
?>
<?php

  $id = $_GET['id'];
  $sql = "SELECT * FROM tbl_package WHERE pk_id=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("i",$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $_SESSION['route'] = array();
  

  $temp =   explode("|",$row['pk_route']);
  for ($i = 0; $i<count($temp);$i++)
    array_push($_SESSION['route'],$temp[$i]);
?>
<div class="container">
  <h3 class="text-center">แก้ไขโปรแกรมท่องเที่ยว</h3>
  <form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
        <div class="form-group">
          <label for="pk_title"><strong>ชื่อโปรแกรม</strong></label>
          <input type="text" class="form-control" value="<?php echo $row['pk_title']?>" id="pk_title" name="pk_title" autofocus>
        </div>
        <div class="form-group">
          <label for="pk_description"><strong>คำอธิบาย</strong></label>
          <textarea class="form-control" rows="8" id="pk_description" name="pk_description" style="resize:none"><?php echo $row['pk_description']?></textarea>
        </div>
        <div class="form-group">
          <label for="pk_budget"><strong>งบประมาณ</strong></label>
          <input type="text" class="form-control" value="<?php echo $row['pk_budget']?>" min="0" id="pk_budget" name="pk_budget" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['pk_budget']?>';}">
        </div>
        <div class="form-group">
          <label for="pk_days"><strong>จำนวนวัน</strong></label>
          <input type="text" class="form-control" value="<?php echo $row['pk_days']?>" min="0" id="pk_days" name="pk_days" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['pk_days']?>';}">
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
          
          
          <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" onclick="clearRoute()"><i class="fas fa-trash"></i> ลบทั้งหมด</a>

        </div>
        <div class="form-group">
        <label for="program_file"><strong>รูปภาพ</strong></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="program_file" name="program_file" accept="image/png">
          <label class="custom-file-label" for="program_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="../assets/img/package/<?php echo $row['pk_id'] ?>/preview<?=$id?>.png?cache=none" class="img-fluid">
      </div>
      </div>
      <div class="text-right mt-5">
      <a href="editprogram.php?id=<?php echo $row['pk_id'] ?>" class="btn btn-info full-width-on-mobile">
          <span class=""> <i class="fas fa-sync-alt"></i></span> รีเซ็ต
        </a>
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
alert(index+poi_name);
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

      

    </div>
  </form>
</div>
<?php require("template/footer.php") ?>
