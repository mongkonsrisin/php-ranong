<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_poi WHERE poi_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$poi_id = $row['poi_id'];
?>
<div class="container">
  <h3 class="text-center">แก้ไขสถานที่</h3>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {


        $poi_name = trim($_POST['poi_name']);
        $poi_description = trim($_POST['poi_description']);
        $poi_ismain = trim($_POST['poi_ismain']);
        $poi_cat = trim($_POST['poi_cat']);
        $poi_type = trim($_POST['poi_type']);
        $poi_pin = trim($_POST['poi_pin']);
        $poi_lat = trim($_POST['poi_lat']);
        $poi_lng = trim($_POST['poi_lng']);
        $poi_housenumber = trim($_POST['poi_housenumber']);
        $poi_moo = trim($_POST['poi_moo']);
        $poi_alley = trim($_POST['poi_alley']);
        $poi_street = trim($_POST['poi_street']);
        $poi_subdistrict = trim($_POST['poi_subdistrict']);
        $poi_district = trim($_POST['poi_district']);
        $poi_province = 85;
        $poi_zipcode = trim($_POST['poi_zipcode']);
        $poi_phone = trim($_POST['poi_phone']);
        $poi_mobile = trim($_POST['poi_mobile']);
        $poi_website = trim($_POST['poi_website']);
        $poi_email = trim($_POST['poi_email']);
        $poi_facebook = trim($_POST['poi_facebook']);
        $poi_line = trim($_POST['poi_line']);
        $cat = trim($_POST['cat']);

        $poi_username = trim($_POST['poi_username']);
        $poi_password = trim($_POST['poi_password']);
        $poi_cpassword = trim($_POST['poi_cpassword']);
        

        if (empty($poi_name) || empty($poi_ismain) || empty($poi_cat) || empty($poi_type) || empty($poi_pin) ||
        empty($poi_lat) || empty($poi_lng) || empty($poi_subdistrict) || empty($poi_district) || empty($poi_zipcode) || empty($poi_username)) {
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
        $sql_update = "UPDATE tbl_poi  SET poi_name=?,poi_description=?,poi_ismain=?,
            poi_cat=?,poi_type=?,poi_pin=?,poi_lat=?,poi_lng=?,poi_housenumber=?,poi_moo=?,poi_alley=?,poi_street=?,
            poi_subdistrict=?,poi_district=?,poi_province=?,poi_zipcode=?,poi_phone=?,poi_mobile=?,poi_website=?,
            poi_email=?,poi_facebook=?,poi_line=?,poi_username=? WHERE poi_id=?";


              $stmt_update = $con->prepare($sql_update);



              $stmt_update->bind_param("sssssssssssssssssssssssi",
              $poi_name,$poi_description,$poi_ismain,$poi_cat,$poi_type,$poi_pin,
              $poi_lat,$poi_lng,$poi_housenumber,$poi_moo,$poi_alley,
              $poi_street,$poi_subdistrict, $poi_district,$poi_province,$poi_zipcode,$poi_phone,
              $poi_mobile,$poi_website,$poi_email,$poi_facebook,$poi_line,$poi_username,$id);
              $stmt_update->execute();


              //Upload image.
              //TODO: Upload S and M
              if(!empty($_FILES['pro_file']['tmp_name'])) {
                $path1 = "../assets/img/poi/s/";
                $path = $path1 . $id . '.png';
                file_put_contents($path,file_get_contents($_FILES['poi_file']['tmp_name']));
              }

              //Upload image.
            //TODO: Upload S and M
            $path2 = "../assets/img/banner/$poi_id/";
            $path = $path2 . $id . '.png';

            if(!empty($_FILES['poi_file2']['tmp_name'])) {
              if (!is_dir($path2)) mkdir($path2); 
              file_put_contents($path2."left1.png",file_get_contents($_FILES['poi_file2']['tmp_name']));
            }

            if(!empty($_FILES['poi_file3']['tmp_name'])) {
              if (!is_dir($path2)) mkdir($path2); 
              file_put_contents($path2."left2.png",file_get_contents($_FILES['poi_file3']['tmp_name']));
            }
            if(!empty($_FILES['poi_file4']['tmp_name'])) {
              if (!is_dir($path2)) mkdir($path2); 
              file_put_contents($path2."slide1.png",file_get_contents($_FILES['poi_file4']['tmp_name']));
            }
            if(!empty($_FILES['poi_file5']['tmp_name'])) {
              if (!is_dir($path2)) mkdir($path2); 
              file_put_contents($path2."slide2.png",file_get_contents($_FILES['poi_file5']['tmp_name']));
            }
            if(!empty($_FILES['poi_file6']['tmp_name'])) {
              if (!is_dir($path2)) mkdir($path2); 
              file_put_contents($path2."slide3.png",file_get_contents($_FILES['poi_file6']['tmp_name']));
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
                  window.location.href = 'allpoi.php?cat=$cat';
                });
              }, 100);</script>";
            }

}
?>
<form action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="cat" value="<?=$row['poi_cat']?>">
  <div class="card bg-light border-dark mb-3">
    <div class="card-body">
      <div class="form-group">
        <label for="poi_name"><strong>ชื่อสถานที่ <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_name']?>" id="poi_name" name="poi_name" autofocus>
      </div>
      <div class="form-group">
        <label for="poi_description"><strong>คำอธิบาย</strong></label>
        <textarea class="form-control" rows="8" id="poi_description" name="poi_description" style="resize:none"><?php echo $row['poi_description']?></textarea>
      </div>
      <div class="form-group">
        <label for="poi_ismain"><strong>ประเภทเส้นทาง <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <select class="form-control" id="poi_ismain" name="poi_ismain">
          <option value="1" <?=(($row['poi_ismain']==1)?"selected":'')?>>สถานที่หลัก</option>
          <option value="2" <?=(($row['poi_ismain']==2)?"selected":'')?>>สถานที่ใกล้เคียง</option>
        </select>
      </div>
      <div class="form-group">
        <label for="poi_type"><strong>ประเภทสถานที่ <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <select class="form-control" id="poi_type" name="poi_type">
          <option value="1" <?=(($row['poi_type']==1)?"selected":'')?>>เชิงนิเวศ</option>
          <option value="2" <?=(($row['poi_type']==2)?"selected":'')?>>เชิงสุขภาพ</option>
        </select>
      </div>
      <div class="form-group">
        <label for="poi_cat"><strong>หมวดหมู่สถานที่ <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <select class="form-control" id="poi_cat" name="poi_cat">
          <?php
          $sql_cat = "SELECT * FROM tbl_category ORDER BY cat_name ASC";
          $stmt_cat = $con->prepare($sql_cat);
          $stmt_cat->execute();
          $result_cat= $stmt_cat->get_result();
          while($row_cat = $result_cat->fetch_assoc()) {
            $sel = ($row['poi_cat']==$row_cat['cat_id'])?'selected':'';
            ?>
            <option value="<?php echo $row_cat['cat_id']?>" <?=$sel?>><?php echo $row_cat['cat_name']?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="poi_pin"><strong>รูปหมุด <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <select class="form-control" id="poi_pin" name="poi_pin">
          <?php
          $sql_pin = "SELECT * FROM tbl_pin ORDER BY pin_name ASC";
          $stmt_pin = $con->prepare($sql_pin);
          $stmt_pin->execute();
          $result_pin= $stmt_pin->get_result();
          while($row_pin = $result_pin->fetch_assoc()) {
            $sel = ($row['poi_pin']==$row_pin['pin_id'])?'selected':'';
            ?>
            <option value="<?php echo $row_pin['pin_id']?>" <?=$sel?>><?php echo $row_pin['pin_name']?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="poi_lat"><strong>ละติจูด <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_lat']?>" id="poi_lat" name="poi_lat" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['poi_lat']?>';}">
      </div>
      <div class="form-group">
        <label for="poi_lng"><strong>ลองจิจูด <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_lng']?>" id="poi_lng" name="poi_lng" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['poi_lng']?>';}">
      </div>
      <div class="form-group">
        <label for="poi_housenumber"><strong>บ้านเลขที่</strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_housenumber']?>" id="poi_housenumber" name="poi_housenumber" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['poi_housenumber']?>';}">
      </div>
      <div class="form-group">
        <label for="poi_moo"><strong>หมู่</strong></label>
        <input type="tesx" class="form-control" value="<?php echo $row['poi_moo']?>" id="poi_moo" name="poi_moo">
      </div>
      <div class="form-group">
        <label for="poi_alley"><strong>ซอย</strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_alley']?>" id="poi_alley" name="poi_alley">
      </div>
      <div class="form-group">
        <label for="poi_street"><strong>ถนน</strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_street']?>" id="poi_street" name="poi_street">
      </div>
      <div class="form-group">
        <label for="poi_subdistrict"><strong>ตำบล <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <select class="form-control" id="poi_subdistrict" name="poi_subdistrict">
          <?php
          if(!empty($row['poi_district'])) {
          $am_id = $row['poi_district'];
          $sql_sub = "SELECT * FROM tbl_subdistrict WHERE sub_amid=$am_id ORDER BY sub_thainame ASC";
          $stmt_sub = $con->prepare($sql_sub);
          $stmt_sub->execute();
          $result_sub= $stmt_sub->get_result();
          while($row_sub = $result_sub->fetch_assoc()) {
            $selected = '';
            if($row_sub['sub_id'] == $row['poi_subdistrict']) {
              $selected = ' selected';
            }
            ?>
            <option value="<?php echo $row_sub['sub_id']?>" <?php echo $selected ?>><?php echo $row_sub['sub_thainame']?></option>
          <?php } } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="poi_district"><strong>อำเภอ <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <select class="form-control" id="poi_district" name="poi_district">
          <option value="0" selected disabled>กรุณาเลือกอำเภอ...</option>
          <?php
          $sql_dis = "SELECT * FROM tbl_district WHERE dis_proid=85 ORDER BY dis_thainame ASC";
          $stmt_dis = $con->prepare($sql_dis);
          $stmt_dis->execute();
          $result_dis= $stmt_dis->get_result();
          while($row_dis = $result_dis->fetch_assoc()) {
            $selected = '';
            if($row_dis['dis_id'] == $row['poi_district']) {
              $selected = ' selected';
            }
            ?>
            <option value="<?php echo $row_dis['dis_id']?>" <?php echo $selected ?>><?php echo $row_dis['dis_thainame']?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="poi_province"><strong>จังหวัด <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control"  id="poi_province" name="poi_province" value="ระนอง" disabled>
      </div>
      <div class="form-group">
        <label for="poi_zipcode"><strong>รหัสไปรษณีย์ <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control"  value="<?php echo $row['poi_zipcode']?>" id="poi_zipcode" name="poi_zipcode" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['poi_zipcode']?>';}">
      </div>
      <div class="form-group">
        <label for="poi_phone"><strong>เบอร์โทรศัพท์บ้าน</strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_phone']?>" id="poi_phone" name="poi_phone" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['poi_phone']?>';}">
      </div>
      <div class="form-group">
        <label for="poi_mobile"><strong>เบอร์โทรศัพท์มือถือ</strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_mobile']?>" id="poi_mobile" name="poi_mobile" onkeyup="if(isNaN(this.value)){ alertswal('กรุณากรอกตัวเลข'); this.value='<?php echo $row['poi_mobile']?>';}">
      </div>
      <div class="form-group">
        <label for="poi_website"><strong>Website</strong><small class="text-danger"> ( https://www.ranong.com )</small></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_website']?>" id="poi_website" name="poi_website">
      </div>
      <div class="form-group">
        <label for="poi_email"><strong>Email</strong><small class="text-danger"> ( ranong@ranong.com )</small></label>
        <input type="email" class="form-control"  value="<?php echo $row['poi_email']?>" id="poi_email" name="poi_email">
      </div>
      <div class="form-group">
        <label for="poi_facebook"><strong>Facebook</strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_facebook']?>" id="poi_facebook" name="poi_facebook">
      </div>
      <div class="form-group">
        <label for="poi_line"><strong>Line</strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_line']?>" id="poi_line" name="poi_line">
      </div>
      <hr>
      <div class="form-group">
        <label for="poi_username"><strong class="text-primary"><i class="fa fa-user"></i> ชื่อผู้ใช้ <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="text" class="form-control" value="<?php echo $row['poi_username']?>" id="poi_username" name="poi_username">
      </div>
      <div class="form-group">
        <label for="poi_password"><strong class="text-primary"><i class="fa fa-lock"></i> รหัสผ่าน <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="password" class="form-control" id="poi_password" name="poi_password" >
      </div>
      <div class="form-group">
        <label for="poi_cpassword"><strong class="text-primary"><i class="fa fa-lock"></i> ยืนยันรหัสผ่าน <sup class="text-danger font-weight-bold">*</sup></strong></label>
        <input type="password" class="form-control" id="poi_cpassword" name="poi_cpassword" >
      </div>
      <div class="alert alert-warning">หาก<b><u>ไม่ต้องการ</u></b>เปลี่ยนรหัสผ่าน ให้<b><u>เว้น</u></b>ช่องรหัสผ่านไว้<br>
      หาก<b><u>ต้องการ</u></b>เปลี่ยนรหัสผ่าน ให้<b><u>กรอก</u></b>รหัสผ่านใหม่ที่ต้องการ</div>
      <hr>
      <div class="form-group">
        <label for="poi_file"><strong>รูปสถานที่หลัก</strong><sup class="text-danger font-weight-bold">*</sup><small class="text-danger"> ( ใช้ไฟล์รูปประเภท .png ขนาด 300x300 )</small></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="poi_file" name="poi_file" accept="image/png">
          <label class="custom-file-label" for="poi_file">เลือกรูป</label>
        </div>
        <br><br>
        <img id="preview" src="../assets/img/poi/s/<?php echo $row['poi_id'] ?>.png?cache=none" class="img-fluid">
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="poi_file2"><strong>รูปซ้าย 1</strong><small class="text-danger"> ( ใช้ไฟล์รูปประเภท .png ขนาด 395x250 )</small></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="poi_file2" name="poi_file2" accept="image/png">
              <label class="custom-file-label" for="poi_file2">เลือกรูป</label>
            </div>
            <br><br>
            <img id="preview2" src="../assets/img/banner/<?php echo $row['poi_id'] ?>/left1.png?cache=none" class="img-fluid">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="poi_file3"><strong>รูปซ้าย 2</strong><small class="text-danger"> ( ใช้ไฟล์รูปประเภท .png ขนาด 395x250 )</small></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="poi_file3" name="poi_file3" accept="image/png">
              <label class="custom-file-label" for="poi_file2">เลือกรูป</label>
            </div>
            <br><br>
            <img id="preview3" src="../assets/img/banner/<?php echo $row['poi_id'] ?>/left2.png?cache=none" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="poi_file4"><strong>รูปสไลด์ 1</strong><small class="text-danger"> ( ใช้ไฟล์รูปประเภท .png ขนาด 830x544 )</small></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="poi_file4" name="poi_file4" accept="image/png">
              <label class="custom-file-label" for="poi_file4">เลือกรูป</label>
            </div>
            <br><br>
            <img id="preview4" src="../assets/img/banner/<?php echo $row['poi_id'] ?>/slide1.png?cache=none" class="img-fluid">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="poi_file5"><strong>รูปสไลด์ 2</strong><small class="text-danger"> ( ใช้ไฟล์รูปประเภท .png ขนาด 830x544 )</small></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="poi_file5" name="poi_file5" accept="image/png">
              <label class="custom-file-label" for="poi_file5">เลือกรูป</label>
            </div>
            <br><br>
            <img id="preview5" src="../assets/img/banner/<?php echo $row['poi_id'] ?>/slide2.png?cache=none" class="img-fluid">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="poi_file6"><strong>รูปสไลด์ 3</strong><small class="text-danger"> ( ใช้ไฟล์รูปประเภท .png ขนาด 830x544 )</small></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="poi_file6" name="poi_file6" accept="image/png">
              <label class="custom-file-label" for="poi_file6">เลือกรูป</label>
            </div>
            <br><br>
            <img id="preview6" src="../assets/img/banner/<?php echo $row['poi_id'] ?>/slide3.png?cache=none" class="img-fluid">
          </div>
        </div>
      </div>

      <div class="text-right mt-5">
      <a href="editpoi.php?id=<?php echo $row['poi_id'] ?>" class="btn btn-info full-width-on-mobile">
          <span class=""> <i class="fas fa-sync-alt"></i></span> รีเซ็ต
        </a>
        <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
      </div>
    </div>
  </form>
</div>
<script>
function readURL(input,preview) {
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
    if (preview==1) $('#preview').attr('src', e.target.result);
    if (preview==2) $('#preview2').attr('src', e.target.result);
    if (preview==3) $('#preview3').attr('src', e.target.result);
    if (preview==4) $('#preview4').attr('src', e.target.result);
    if (preview==5) $('#preview5').attr('src', e.target.result);
    if (preview==6) $('#preview6').attr('src', e.target.result);
   }
   reader.readAsDataURL(input.files[0]);
  }
 }
}
$("#poi_file").change(function() {
        readURL(this,1);
      });
      $("#poi_file2").change(function() {
        readURL(this,2);
      });
      $("#poi_file3").change(function() {
        readURL(this,3);
      });
      $("#poi_file4").change(function() {
        readURL(this,4);
      });
      $("#poi_file5").change(function() {
        readURL(this,5);
      });
      $("#poi_file6").change(function() {
        readURL(this,6);
});




$(function(){
  var zipcodes = [];
  var defaultOption = '<option value="0" selected disabled>กรุณาเลือกตำบล...</option>';
  $('#poi_district').change(function() {
    zipcodes = [];
    $('#poi_zipcode').val('');
    $("#poi_subdistrict").html(defaultOption);
    $.ajax({
      url: "ajax/get_subdistrict.php",
      data: ({ id: $('#poi_district').val() }),
      dataType: "json",
      success: function(json){
        $.each(json, function(index, value) {
          zipcodes.push(value.sub_zipcode);
          $("#poi_subdistrict").append('<option value="' + value.sub_id +
          '">' +   value.sub_thainame +  '</option>');
        });
      }
    });
  });

  $('#poi_subdistrict').change(function() {
    var index = $("#poi_subdistrict option:selected").index() - 1;
    $('#poi_zipcode').val(zipcodes[index]);

  });

});

</script>
<?php require("template/footer.php") ?>
