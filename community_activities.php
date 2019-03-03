<?php require_once('navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="google" content="notranslate" />
    <meta content="Mashup templates have been developped by Orson.io team" name="author">
    <meta name="Keywords" content="ระนอง, ranong, รักนะระนอง, ท่องเที่ยว, สินค้าชุมชน, โปรแกรมท่องเที่ยว, travel, เชิงนิเวศ, เชิงสุขภาพ, ทะเล, เที่ยวไทย, ภาคใต้">
  <meta name="Description" content="'รักนะระนอง (Love at Ranong)' แอปพลิเคชันแนะนำสถานที่ท่องเที่ยว ที่พัก ร้านอาหาร ร้านค้าหรือแหล่งจำหน่ายสินค้าชุมชน/สินค้าหนึ่งตำบลหนึ่งผลิตภัณฑ์ที่นักท่องเที่ยวนักเดินทางไม่ควรพลาด สำหรับที่จะใช้เวลาพักผ่อนไปในจังหวัดระนอง ซึ่งจะมีโปรแกรมท่องเที่ยวแนะนำที่ช่วยวางแผนการเดินทาง และให้นักท่องเที่ยวประมาณการงบประมาณค่าใช้จ่ายและระยะเวลาที่จะใช้ในการท่องเที่ยวในทริปหนึ่งได้ 
ทั้งนี้ระบบจะแสดงแผนที่กูเกิ้ล เพื่อให้ท่านสามารถเดินทางไปยังจุดหมายที่แนะนำในจังหวัดระนองในรูปแบบของการท่องเที่ยวเชิงนิเวศ และการท่องเที่ยวเชิงสุขภาพ รวมทั้งแสดงรายละเอียดและข้อมูลติดต่อสถานที่ท่องเที่ยว ที่พัก ร้านอาหารและแหล่งจำหน่ายสินค้าอีกด้วย
'รักท่องเที่ยว รักธรรมชาติ รักระนอง' ระนอง เป็นจังหวัดชายฝั่งทะเลด้านตะวันตกในภาคใต้ของประเทศไทย มีพื้นที่ประมาณ 2 ล้านไร่ ทิศตะวันตกติดกับทะเลอันดามันและประเทศเมียนมาร์ซึ่งครอบคลุมไปถึงทิศเหนือ ทิศตะวันออกติดกับจังหวัดชุมพร ส่วนทิศใต้ติดกับจังหวัดพังงาและสุราษฏร์ธานี แหล่งท่องเที่ยวที่นิยมในระนองจะมีน้ำตกและบ่อน้ำร้อนหลายแห่ง ให้นักท่องเที่ยวได้มาอาบน้ำแร่ธรรมชาติได้ตามอัธยาศัย">
    <link rel="stylesheet" href="assets/css/otop_global.css">

    <link rel="stylesheet" href="assets/css/otop_responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    
    
    <!-- script code -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    
    <!-- slick -->
    <link rel="stylesheet" href="assets/source_slickslide/slick-theme.css" media="screen">
    <link rel="stylesheet" href="assets/source_slickslide/slick.css" media="screen">
    <!-- js slick -->
    <script src="assets/source_slickslide/slick.js"></script>
    
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    

    
    
    
    <title>OTOP</title>
    
    <link href="assets/css/main.550dcf66.css" rel="stylesheet">
    
    
    <style>
      
      body {
        font-family: 'Kanit' !important;
        background-image: url(assets/img/otop/pbg1.png);
        background-size: cover;
        background-attachment: fixed;
        background-position: center center;
        background-repeat: no-repeat;
        
      }
      h4{
        font-family: 'Kanit' !important;
      }
      .container-fluid {
        position: relative;
        font-family: 'Kanit', sans-serif ;
      }
      
      .container-fluid .content {
        position: absolute;
        left:20px;
        bottom: 0px;
        background: rgba(178, 235, 242, 0.8); /* Black background with transparency */
        color: #f1f1f1;
        width: 90%;
        border-radius: 8px  ;
        
        
      }
      
      
      .caption {
        position: absolute;
        top: 50%;
        min-height: 50px;
        width: 100%;
        text-align: center;
        color: #000;
      }
      
      .text-block {
        position: absolute;
        bottom: 353px;
        right:90px;
        width:200px;
        background-color: #3399ff;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .text-block1 {
        position: absolute;
        bottom: 353px;
        right:95px;
        width:200px;
        background-color: #3399ff;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .text-block2 {
        position: absolute;
        bottom: 353px;
        right:95px;
        width:200px;
        background-color: #3399ff;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      
      .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #3399ff;
        overflow: hidden;
        width: 100%;
        height: 100%;
        -webkit-transform:scale(0);
        transition: .3s ease;
      }
      /* The Modal (background) */
      .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      }
      
      /* Modal Content */
      .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        
      }
      
      /* The Close Button */
      .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }
      
      .close:hover,
      .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
      }
      
      </style>

<style>
  * {
    box-sizing: border-box;
  }
  
  /* Create two equal columns that floats next to each other */
  .column {
    float: left;
    width: 50%;
    padding: 10px;
  }
  
  .column img {
    margin-top: 12px;
  }
  
  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  </style>

</head>

<body>  <!-- Add your content of header -->

<header>

<div class="container">
  <div class="navbar-header">

    <a class="navbar-brand" href="./index.html" title="">
    </a>
  </div>
  <div>
    <ul class="nav navbar-nav navbar-right">

    </ul>
  </div>

</div>
</nav>
</header>
    
    
    <div class="section-container">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-4">
            
            <div class="row">
              <div class="col-md-12">
                <div style="padding: 0.5cm 0.5cm 3cm 0.5cm; background:#ffffff;"  >
                <img src="assets/img/otop/CommunityActivities/EAK_7099.png"  class="img-responsive reveal-content"   style="border-radius: 10px 10px; ">
              </div>



              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"style="color:#000000;" >&times;</button>
                      <h4 class="modal-title">รูปกิจกรรม</h4>
                    </div>
                    <div class="modal-body">



  <div class="row">
    <div class="column">
      <img src="assets/img/otop/CommunityActivities/EAK_7085.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7087.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7088.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7101.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7090.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7122.png"  class="img-responsive reveal-content" >
    </div>
    <div class="column">
      <img src="assets/img/otop/CommunityActivities/EAK_7094.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7100.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7089.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7102.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7103.png"  class="img-responsive reveal-content" >
      <img src="assets/img/otop/CommunityActivities/EAK_7121.png"  class="img-responsive reveal-content" >
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal" style="color:#000000;">ปิด</button>
</div>
</div>
</div>
</div>


<div  align="right">
  <img src="assets/img/otop/CommunityActivities/7093.PNG"  class="img-responsive reveal-content"  data-toggle="modal" data-target="#myModal"  style="  position: absolute;bottom:60px;right:10px;width:80px;">
  <font size="5px"style="  position: absolute;bottom:75px;right:80px; "> กลุ่มเซรามิกบ้านส้มแป้น </font>
</div>


</div>
</div>
</div>
</div>
</div>
</div>

<br><br><br><br><br><br><br>


<?php require_once('footer.php'); ?>
