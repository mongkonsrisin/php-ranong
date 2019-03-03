<?php require("template/header.php") ?>
<?php
if(isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
  exit();
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
  $user = trim($_POST['user']);
  $pass = trim($_POST['pass']);
  $pass = md5($pass);

  $sql = "SELECT * FROM tbl_admin WHERE admin_user = ? AND admin_pass = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("ss",$user,$pass);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user'] = $row['admin_user'];
    $_SESSION['role'] = $row['admin_role'];
    $_SESSION['id'] = $row['admin_id'];
    echo "<script>setTimeout(function () {
      swal({
        title: 'ยินดีต้อนรับ',
        text: '',
        type: 'success',
        closeOnCancel: false,
        allowOutsideClick: false
      },
      function(){
        window.location.href = 'index.php';
      });
    }, 100);</script>";

  } else {
    echo "<script>setTimeout(function () {
      swal({
        title: 'ข้อผิดพลาด',
        text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
        type: 'error',
        closeOnCancel: false,
        allowOutsideClick: false
      });
    }, 100);</script>";
  }



}

?>
<form class="form-signin text-center" action="" method="post">
      <img class="mb-4" src="assets/img/appicon_color.png" alt="" width="120" height="120">
      <br>
      <h3 class="mb-3"><b>ผู้ดูแลระบบ</b></h3>
      <label for="user" class="sr-only">ชื่อผู้ใช้</label>
      <input type="text" value="<?php if(isset($_POST['user'])) { echo $_POST['user'];} ?>" id="user" name="user" placeholder="ชื่อผู้ใช้" class="form-control" style="font-size:1em;" required autofocus>
      <label for="pass" class="sr-only">รหัสผ่าน</label>
      <input type="password" id="pass" name="pass" placeholder="รหัสผ่าน" class="form-control" style="font-size:1em;" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
      <p class="mt-5 mb-3 text-muted">&copy; สำนักงานจังหวัดระนอง</p>
</form>
<?php require("template/footer.php") ?>
