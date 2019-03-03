<?php //require("config/session.php");?>
<?php require("config/dbconfig.php");?>
<?php require("checkdata.php");?>
<link rel="shortcut icon" href="../assets/img/all/icon.ico">
<html>
<head>
  <title>รักนะระนอง</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.0/sweetalert.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://unpkg.com/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.0/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.js"></script>
  <script>
  function alertswal(text){
  swal({
      title: 'ข้อผิดพลาด',
      text: text,
      type: 'error',
      closeOnCancel: false,
      allowOutsideClick: false
   });
}
</script>
  <style>
  html , body {
    font-family: 'Kanit', sans-serif;
  }
  @media (max-width: 768px) {
    .full-width-on-mobile {
      width:100%;
      padding: 0.5rem 1rem;
      font-size: 1.25rem;
      line-height: 1.5;
      border-radius: 0.3rem;
    }
  }
  html {
    position: relative;
    min-height: 100%;
    overflow-y: scroll;
    overflow-x: hidden;
  }
  body {
    padding-top: 120px;
    margin-bottom: 120px;
    background-color: #f0f0f0;
  }
  .footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    line-height: 60px;
    z-index: 1;
  }
  .form-wrapper {
    max-width: 480px;
    margin: 0 auto;
  }
  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
  }
  .form-signin .checkbox {
    font-weight: 400;
  }
  .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
  }
  .form-signin .form-control:focus {
    z-index: 2;
  }
  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
  body.modal-open {
    overflow-y: auto !important;
    padding-right: 0 !important;
  }
  .modal-scrollbar-measure {
    overflow: hidden;
  }
  .line-color {
    color: #5fc52e;
  }
  .facebook-color {
    color: #3a559f;
  }
  .sweet-alert{
    font-family: 'Kanit', sans-serif !important;
  }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php">
      <img src="assets/img/appicon_color.png" width="30" height="30" class="d-inline-block align-top" alt="">
      รักนะระนอง
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <?php
      if(isset($_SESSION['user'])) {
    ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
      <?php if( $_SESSION['role'] == 'admin') {?>
      <li class="nav-item">
            <a class="nav-link" href="changepassword.php">เปลี่ยนรหัสผ่าน</a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">ออกจากระบบ</a>
          </li>
      </ul>
    </div>
    <?php } ?>
  </nav>
