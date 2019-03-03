<?php date_default_timezone_set("Asia/Bangkok"); ?>
<?php require_once('db_config.php'); ?>
<link rel="shortcut icon" href="assets/img/all/icon.ico">
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="Keywords" content="ระนอง, ranong, รักนะระนอง, ท่องเที่ยว, สินค้าชุมชน, โปรแกรมท่องเที่ยว, travel, เชิงนิเวศ, เชิงสุขภาพ, ทะเล, เที่ยวไทย, ภาคใต้">
  <meta name="Description" content="'รักนะระนอง (Love at Ranong)' แอปพลิเคชันแนะนำสถานที่ท่องเที่ยว ที่พัก ร้านอาหาร ร้านค้าหรือแหล่งจำหน่ายสินค้าชุมชน/สินค้าหนึ่งตำบลหนึ่งผลิตภัณฑ์ที่นักท่องเที่ยวนักเดินทางไม่ควรพลาด สำหรับที่จะใช้เวลาพักผ่อนไปในจังหวัดระนอง ซึ่งจะมีโปรแกรมท่องเที่ยวแนะนำที่ช่วยวางแผนการเดินทาง และให้นักท่องเที่ยวประมาณการงบประมาณค่าใช้จ่ายและระยะเวลาที่จะใช้ในการท่องเที่ยวในทริปหนึ่งได้ 
ทั้งนี้ระบบจะแสดงแผนที่กูเกิ้ล เพื่อให้ท่านสามารถเดินทางไปยังจุดหมายที่แนะนำในจังหวัดระนองในรูปแบบของการท่องเที่ยวเชิงนิเวศ และการท่องเที่ยวเชิงสุขภาพ รวมทั้งแสดงรายละเอียดและข้อมูลติดต่อสถานที่ท่องเที่ยว ที่พัก ร้านอาหารและแหล่งจำหน่ายสินค้าอีกด้วย
'รักท่องเที่ยว รักธรรมชาติ รักระนอง' ระนอง เป็นจังหวัดชายฝั่งทะเลด้านตะวันตกในภาคใต้ของประเทศไทย มีพื้นที่ประมาณ 2 ล้านไร่ ทิศตะวันตกติดกับทะเลอันดามันและประเทศเมียนมาร์ซึ่งครอบคลุมไปถึงทิศเหนือ ทิศตะวันออกติดกับจังหวัดชุมพร ส่วนทิศใต้ติดกับจังหวัดพังงาและสุราษฏร์ธานี แหล่งท่องเที่ยวที่นิยมในระนองจะมีน้ำตกและบ่อน้ำร้อนหลายแห่ง ให้นักท่องเที่ยวได้มาอาบน้ำแร่ธรรมชาติได้ตามอัธยาศัย">
  <title>รักนะระนอง</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/fonts/font.css">
  <link rel="stylesheet" href="assets/css/navbar.css">
  <link rel="stylesheet" href="assets/css/index_bootstrap.css">
  <link rel="stylesheet" href="assets/css/index_global.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/w3.css">
  <link rel="stylesheet" href="assets/css/jquery-ui.css" />
  <link rel="stylesheet" href="assets/css/jquery-ui-timepicker-addon.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.css">

  <!-- JAVASCRIPT -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/jquery-ui.min.js"></script>  
  <script src="assets/js/jquery-ui-timepicker-addon.js"></script>          
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.js"></script>
 
  
  <script type="text/javascript">
    $(function(){
	  var startDateTextBox = $('#dateStart');
    var endDateTextBox = $('#dateEnd');
    
	startDateTextBox.datepicker({ 
        minDate: 0,
        dateFormat: 'dd/mm/yy',
        closeText: 'ปิด',
        prevText: '<ก่อน',
        nextText: 'หลัง>',
        currentText: 'เวลาปัจจุบัน',
        monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
        monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
        dayNames: ['วันอาทิตย์','วันจันทร์','วันอังคาร','วันพุธ','วันพฤหัสบดี','วันศุกร์','วันเสาร์'],
        dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		onClose: function(dateText, inst) {
			endDateTextBox.datepicker('option', 'minDate', startDateTextBox.datepicker('getDate'));
			endDateTextBox.val(dateText);
		}
	});
	endDateTextBox.datepicker({ 
        minDate: 0,
        dateFormat: 'dd/mm/yy',
        closeText: 'ปิด',
        prevText: '<ก่อน',
        nextText: 'หลัง>',
        currentText: 'เวลาปัจจุบัน',
        monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
        monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
        dayNames: ['วันอาทิตย์','วันจันทร์','วันอังคาร','วันพุธ','วันพฤหัสบดี','วันศุกร์','วันเสาร์'],
        dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.']
	});
});
</script>

<style>
.text {
  color: #ffffff;
  font-size: 35px;
  padding: 8px 12px;
  position: absolute;
  bottom: 100px;
  right:350px;
  width: 100%;
  text-align: right;
}

.form-wrapper2{
    background-color:rgba(0, 24, 72, 0.6);
    text-align: center;
    margin-top: 50px;
    border-radius: 10px;
}


</style>


 
</head>

<body>

<div class="home-wrapper">

<!-- START MENU-->
<?php require_once('navbar_index.php') ?>
<!-- END MENU-->

 <!-- The slideshow -->
 <div id="demo" class="carousel slide" data-ride="carousel" style="position:absolute; z-index:-1;">
  <div class="carousel-inner">
        <?php 

        $sql = "SELECT * FROM tbl_slider WHERE sld_show = 1 order by sld_id asc";
        $result = mysqli_query($con,$sql);
        $i =1;
         while($row = mysqli_fetch_assoc($result)) {
          
            ?>

    <div class="carousel-item <?php echo ($i==1)?'active':'';?>">
      <img src="assets/img/slide/<?=$row['sld_id']?>.png?cache=none" style="width:100%;height:1130px;">
      <div class="text form-wrapper2 d-none d-md-block" style="width:auto;"><?=$row['sld_name']?></div> 

    </div>

     <?php $i++;  } ?>

  
  </div>
</div>
<!-- End slideshow -->

<div class="d-none d-xl-block">
  <div class="bird" style="z-index:-1;">
    <img src="assets/img/all/outline-bird.png" style="width:60%;">
  </div>
  <div class="cloud" style="z-index:-1;">
    <img src="assets/img/all/outline-cloud.png" alt="">
  </div>
</div>
<div class="d-none d-lg-block d-xl-none">

  <div class="cloud" style="z-index:-1;">
    <img src="assets/img/all/outline-cloud.png" style="width:30%;background-size: 80px;background-position:70px 50px;">
  </div>
</div>
<div class="d-none d-sm-none d-md-none d-lg-block d-xl-block">
  <div class="camera d-lg-none d-xl-block" style="z-index:-1;">
    <img src="assets/img/all/outline-camera.png" alt="">
  </div>
  <div class="backpack">
    <img src="assets/img/all/outline-bag.png" alt="">
  </div>
</div>


<div class="container">
  <div class="text-center">
    <div class="d-none d-lg-block d-xl-block">
    <img src="assets/img/all/loveranong.png" class="textindex" style="max-width:100%;">
  </div>
 <div class="d-block d-lg-none d-xl-none">
    <img src="assets/img/all/loveranong.png" class="textindex" style="width:500px;max-width:100%;margin-top:5px;">
  </div>  
  </div>


<!-- PHP Start -->
<?php 

function strdate2intDate($strdate)
{ // convert String Thai Date to Integer Date as Number
 $strdate=str_replace("-","/",$strdate);
 list($day,$month, $year) = explode('/', $strdate);
 $year=(int)$year-543;
 return  number_format(((mktime(7, 0, 0, (int)$month,(int)$day, (int)$year)/86400)+719163),0,'','');
}


    if(isset($_GET['search'])){
        $dateStart = $_GET['dateStart'];
        $dateEnd = $_GET['dateEnd'];
        $category = $_GET['category'];
        $type = $_GET['type'];
        $budget = $_GET['budget'];
        $people = $_GET['people'];

        $date = strdate2intDate($dateEnd)-strdate2intDate($dateStart)+1;

        if($type==1) $condition=" and pk_car=1";
        else if($type==2) $condition=" and pk_motorcycle=1";
        else if($type==3) $condition=" and pk_bicycle=1";
        else $condition="";

        if($category==1) $condition2=" and pk_category=1";
        else if($category==2) $condition2=" and pk_category=2";
        else $condition2="";

        if($date>0) $condition.=" and pk_days<=($date)";
      
      $sql = "SELECT * FROM tbl_package WHERE pk_budget<=($budget/$people) $condition $condition2";
      $result = mysqli_query($con,$sql);
      $total = mysqli_num_rows($result);
    ?>
    <!-- // Modal -->
      <div id="id01" class="w3-modal w3-animate-opacity" style="z-index:100;">
          <div class="w3-modal-content w3-card-4" >
            <header class="w3-container w3-teal"> 
              <span onclick="document.getElementById('id01').style.display='none'" 
              class="w3-button w3-display-topright">&times;</span>
              <h2 style="font-size:1.6em;"><i class="fas fa-gift"></i> โปรแกรมท่องเที่ยว</h2>
            </header>
            <!-- Content Modle -->
            <div class="container">
            <?php 
              if($total>0)
              {
                while($row=mysqli_fetch_assoc($result))
                {
                  ?>
                  <br>
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title" style="font-size:1.2em;"><?php echo "<p>".$row['pk_title']."</p>";?></h4>
                      <div class="row"><?php echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;".$row['pk_description']."</p>";?></div>
                      <div class="row"><div class="col-1"><img src="assets/img/all/notes.png" alt="" height="35px"></div><div class="card-text col-11" style="font-size:1.1em;"> &nbsp;ราคา: <?php echo number_format($row['pk_budget']);?>/คน</i></div></div>
                      <a href="package<?=$row['pk_id']?>.php" class="btn btn-primary btn-block"><i class="fa fa-search"></i> ดูรายละเอียด</a>
                    </div>
                  </div>
                  <?php
                }
              }else
              {
                ?>
                <br><div style="text-align: center;font-size:20px;color:#ff4c4c;"><b>ไม่พบข้อมูลแพ็กเกจท่องเที่ยว!</b></div>
                <META HTTP-EQUIV='Refresh' CONTENT = '1.5;URL=poi.php?cat=2'>
                <?php
              }
            ?>
            </div>
            <!-- End Content Modle -->
            <br>
            <footer class="w3-container w3-teal" style="height:30px;">
              
            </footer>
          </div><br>
        </div>
        <script>document.getElementById('id01').style.display='block';</script>

<?php
}
?>

<style>
  /*
  .ui-datepicker-year:not(.custom-datepicker-year) {
    display:none;

}
*/
  </style>
         <!--START FORM -->
         <div class="form-wrapper" style="font-size:1.0em;">
        <form action="" method="get">
          <h2 class="text-white"><span><img src="assets/img/all/location.png" alt="" height="30px"></span> ค้นหาโปรแกรมท่องเที่ยว</h2>

            <div class="row">
              <div class="col-md-6 col-lg-4">
                <div class="form-group">
                  <?php $todayTh = date('d/m/').( intval(date('Y'))+543); ?>
                   <label class="text-white">วันที่เริ่มเดินทาง :</label>
                   <input type="text" value="<?=$todayTh?>" id="dateStart" name="dateStart" class="form-control datepicker" style="font-size:0.9em;height:40px;">
                </div>
                <div class="form-group">
                   <label class="text-white">ถึงวันที่ :</label>
                   <input type="text" value="<?=$todayTh?>" id="dateEnd" name="dateEnd" class="form-control datepicker" style="font-size:0.9em;height:40px;">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group" >
                  <label class="text-white">ประเภทการท่องเที่ยว :</label>
                    <select name="category" id="category" class="form-control" style="font-size:0.9em;height:43px;">
                      <option value="0">ทั้งหมด(ทุกประเภท)</option>
                      <option value="1">เชิงนิเวศน์</option>
                      <option value="2">เชิงสุขภาพ</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-white">รูปแบบการเดินทาง :</label>
                    <select name="type" id="type" class="form-control" style="font-size:0.9em;height:43px;">
                      <option value="0">ทั้งหมด(ทุกประเภท)</option>
                      <option value="1">รถยนต์</option>
                      <option value="2">จักรยานยนต์</option>
                      <option value="3">จักรยาน</option>
                    </select>
                  </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="text-white">จำนวนงบประมาณ :</label>
                    <input type="number" min="0" name="budget" id="budget" class="form-control" placeholder="บาท" style="font-size:0.9em;height:40px;" oninvalid="this.setCustomValidity('กรุณากรอกงบประมาณ');" oninput="setCustomValidity('');" required autofocus>
                  </div>
                  <div class="form-group">
                    <label class="text-white">จำนวนนักท่องเที่ยว :</label>
                    <input type="number" min="1" name="people" id="people" class="form-control" placeholder="คน" style="font-size:0.9em;height:40px;" oninvalid="this.setCustomValidity('กรุณากรอกจำนวนนักท่องเที่ยว');" oninput="setCustomValidity('');" required autofocus>
                  </div>
              </div>
            </div>
            <div class="row">
            <div class="col-lg-12">
              <button class="btn btn-lg btn-block btn-success" name="search" type="submit" style="font-size:0.9em;">
                <span class="fa fa-search"></span> ค้นหา
              </button>
            </div>
           
            </div>
        </form>
      </div>
    <!--END FORM -->

    
    </div>
  </div>


    <div class="wrapper_content_ranong d-none d-md-block d-sm-block d-lg-block d-sm-none" >
      <div class="container" >
        <div class="travel-menu-ranong">
          <div class="list-travel-ranong">
            <div class="row">
              <div class="col-lg-6 nopaddingright">
                  
                <div class="box-travel-ranong">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-6 nopaddingright">
                     <div class="box-img-ranong">
                        <a href="healthy.php?id=38">
                          <span class="hover"><img src="assets/img/all/black_onsen.png" alt=""></span>
                          <img src="assets/img/favorite/38.gif" alt="">
                        </a>
                        <span class="arrow-left">&nbsp;</span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6 col-6 nopaddingleft" >
                      <div class="box-detail-ranong">
                        <h5 style="font-size:1.3em;">บ่อน้ำร้อนรักษะวาริน</h5>
                        <p style="font-size:0.8em;">บ่อน้ำร้อนสวนสาธารณรักษะวาริน เป็นบ่อน้ำร้อนซึ่งเกิดขึ้นเองตามธรรมชาติ ซึ่งมีอยู่ 3 บ่อหลัก คือ บ่อพ่อ บ่อแม่ และบ่อลูกสาว มีอุณหภูมิประมาณ 65  องศาเซลเซียส</p>
                        <a href="healthy.php?id=38">MORE</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="box-travel-ranong"> 

                  <div class="row">             
                    <div class="col-12 col-sm-6 col-6 nopaddingright">
                      <div class="box-detail-ranong">
                        <h5 style="font-size:1.3em;">ศูนย์วิจัยป่าชายเลนหงาว</h5>
                        <p style="font-size:0.8em;">"พื้นที่สงวนชีวมณฑล" คือพื้นที่ระบบนิเวศบนบก และ/หรือชายฝั่งทะเล/
                          ทะเลที่ได้รับการยอมรับในระดับนานาชาติภายใต้โครงการมนุษย์และชีวมณฑลขององค์การศึกษาวิทยาศาสตร์และวัฒนธรรมแห่ง สหประชาชาติ  (ยูเนสโก)
                          พื้นที่สงวนชีวมณฑลมีวัตถุประสงค์เพื่อการอนุรักษ์และใช้ประโยชน์อย่างยั่งยืนของความหลากหลายทางชีวภาพ</p>
                          <a href="ecosystem.php?id=23">MORE</a>
                        </div>
                      </div>

                      <div class="col-12 col-sm-6 col-6 nopaddingleft">
                        <div class="box-img-ranong">
                          <a href="ecosystem.php?id=23">
                            <span class="hover"><img src="assets/img/all/black_forest.png" alt=""></span>
                            <img src="assets/img/favorite/23.gif" alt="">
                          </a>
                          <span class="arrow-right">&nbsp;</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class=" col-lg-6 nopaddingleft">
                  <div class="box-travel-ranong">
                    <div class="row">
                      <div class="col-12 col-sm-6 col-6 nopaddingright">
                        <div class="box-img-ranong">
                          <a href="ecosystem.php?id=25">
                            <span class="hover"><img src="assets/img/all/black_waterfall.png" alt=""></span>
                            <img src="assets/img/favorite/26.gif" alt="">
                          </a>
                          <span class="arrow-left">&nbsp;</span>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6 col-6 nopaddingleft">
                        <div class="box-detail-ranong">
                          <h5 style="font-size:1.3em;">น้ำตกปุญญบาล</h5>
                          <p style="font-size:0.8em;">
                            เป็นน้ำตกที่มีความสูงราว 15 เมตรและสามารถมองเห็นน้ำตกได้จากริมถนนเลยทีเดียว น้ำตกสายนี้เดิมชื่อ น้ำตกเส็ดตะกวด มีขนาดไม่ใหญ่มากนัก
                            แต่กลับมีน้ำไหลแรงตลอดปี และมีทิวทัศน์สวยงาม โดยน้ำตกมีทั้งหมด 3 ชั้นมีต้นน้ำมาจากลำห้วยเล็กๆ ในเขตป่าละอุ่น ป่าราชกูด โดยแต่ละชั้นมีความน่าสนใจแตกต่างกัน</p>
                            <a href="ecosystem.php?id=25">MORE</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-travel-ranong">
                      <div class="row">
                        <div class="col-12 col-sm-6 col-6 nopaddingright">
                          <div class="box-detail-ranong">
                            <h5 style="font-size:1.3em;">จุดชมวิวเขาฝาชี</h5>
                            <p style="font-size:0.8em;">รายละเอียดสถานที่ท่องเที่ยว
                              ชมทิวทัศน์บนจุดสูงสุดของภูเขาเล็กๆ ที่มีลักษณะคล้ายฝาชีซึ่งอยู่สูงจากระดับน้ำทะเลปานกลาง 259 เมตรแห่งนี้ อยู่ติดกับจุดที่คลองละอุ่นไหลลงแม่น้ำกระบุรี
                              และอ่าวที่กั้นระหว่างจังหวัดระนองกับเมียนมาร์ ยอดเขาฝาชีนั้นเป็นสถานที่ชมวิวที่งดงาม โดยเฉพาะยามตะวันลับฟ้าในตอนเย็น</p>
                              <a href="ecosystem.php?id=30">MORE</a>
                            </div>
                          </div>
                          <div class="col-12 col-sm-6 col-6 nopaddingleft">
                            <div class="box-img-ranong">
                              <a href="ecosystem.php?id=30">
                                <span class="hover"><img src="assets/img/all/black_cloud.png" alt=""></span>
                                <img src="assets/img/favorite/30.gif" alt="">
                              </a>
                              <span class="arrow-right">&nbsp;</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="wrapper_content_ranong d-none  d-block d-sm-none d-md-none d-lg-none" >
      <div class="container" >
        <div class="travel-menu-ranong">
          <div class="list-travel-ranong">
            <div class="row">
              <div class="col-lg-6 nopaddingright">
                  
                <div class="box-travel-ranong">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-6 nopaddingright">
                     <div class="box-img-ranong">
                        <a href="healthy.php?id=38">
                          <span class="hover"><img src="assets/img/all/black_onsen.png" alt=""></span>
                          <img src="assets/img/favorite/38.gif" alt="">
                        </a>
                        <span class="arrow-left">&nbsp;</span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6 col-6 nopaddingleft" >
                      <div class="box-detail-ranong">
                        <h5 style="font-size:1.3em;">บ่อน้ำร้อนรักษะวาริน</h5>
                        <p style="font-size:0.8em;">บ่อน้ำร้อนสวนสาธารณรักษะวาริน เป็นบ่อน้ำร้อนซึ่งเกิดขึ้นเองตามธรรมชาติ ซึ่งมีอยู่ 3 บ่อหลัก คือ บ่อพ่อ บ่อแม่ และบ่อลูกสาว มีอุณหภูมิประมาณ 65  องศาเซลเซียส</p>
                        <a href="healthy.php?id=38">MORE</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="box-travel-ranong"> 

                  <div class="row">             
                      
                      <div class="col-12 col-sm-6 col-6 nopaddingleft">
                        <div class="box-img-ranong">
                          <a href="ecosystem.php?id=23">
                            <span class="hover"><img src="assets/img/all/black_forest.png" alt=""></span>
                            <img src="assets/img/favorite/23.gif" alt="">
                          </a>
                          <span class="arrow-right">&nbsp;</span>
                        </div>
                      </div>

                      <div class="col-12 col-sm-6 col-6 nopaddingright">
                      <div class="box-detail-ranong">
                        <h5 style="font-size:1.3em;">ศูนย์วิจัยป่าชายเลนหงาว</h5>
                        <p style="font-size:0.8em;">"พื้นที่สงวนชีวมณฑล" คือพื้นที่ระบบนิเวศบนบก และ/หรือชายฝั่งทะเล/
                          ทะเลที่ได้รับการยอมรับในระดับนานาชาติภายใต้โครงการมนุษย์และชีวมณฑลขององค์การศึกษาวิทยาศาสตร์และวัฒนธรรมแห่ง สหประชาชาติ  (ยูเนสโก)
                          พื้นที่สงวนชีวมณฑลมีวัตถุประสงค์เพื่อการอนุรักษ์และใช้ประโยชน์อย่างยั่งยืนของความหลากหลายทางชีวภาพ</p>
                          <a href="ecosystem.php?id=23">MORE</a>
                        </div>
                      </div>

                    </div>
                  </div>
                  
                </div>
                <div class=" col-lg-6 nopaddingleft">
                  <div class="box-travel-ranong">
                    <div class="row">
                      <div class="col-12 col-sm-6 col-6 nopaddingright">
                        <div class="box-img-ranong">
                          <a href="ecosystem.php?id=25">
                            <span class="hover"><img src="assets/img/all/black_waterfall.png" alt=""></span>
                            <img src="assets/img/favorite/26.gif" alt="">
                          </a>
                          <span class="arrow-left">&nbsp;</span>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6 col-6 nopaddingleft">
                        <div class="box-detail-ranong">
                          <h5 style="font-size:1.3em;">น้ำตกปุญญบาล</h5>
                          <p style="font-size:0.8em;">
                            เป็นน้ำตกที่มีความสูงราว 15 เมตรและสามารถมองเห็นน้ำตกได้จากริมถนนเลยทีเดียว น้ำตกสายนี้เดิมชื่อ น้ำตกเส็ดตะกวด มีขนาดไม่ใหญ่มากนัก
                            แต่กลับมีน้ำไหลแรงตลอดปี และมีทิวทัศน์สวยงาม โดยน้ำตกมีทั้งหมด 3 ชั้นมีต้นน้ำมาจากลำห้วยเล็กๆ ในเขตป่าละอุ่น ป่าราชกูด โดยแต่ละชั้นมีความน่าสนใจแตกต่างกัน</p>
                            <a href="ecosystem.php?id=25">MORE</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-travel-ranong">
                      <div class="row">
                        
                          <div class="col-12 col-sm-6 col-6 nopaddingleft">
                            <div class="box-img-ranong">
                              <a href="ecosystem.php?id=30">
                                <span class="hover"><img src="assets/img/all/black_cloud.png" alt=""></span>
                                <img src="assets/img/favorite/30.gif" alt="">
                              </a>
                              <span class="arrow-right">&nbsp;</span>
                            </div>
                          </div>

                          <div class="col-12 col-sm-6 col-6 nopaddingright">
                          <div class="box-detail-ranong">
                            <h5 style="font-size:1.3em;">จุดชมวิวเขาฝาชี</h5>
                            <p style="font-size:0.8em;">รายละเอียดสถานที่ท่องเที่ยว
                              ชมทิวทัศน์บนจุดสูงสุดของภูเขาเล็กๆ ที่มีลักษณะคล้ายฝาชีซึ่งอยู่สูงจากระดับน้ำทะเลปานกลาง 259 เมตรแห่งนี้ อยู่ติดกับจุดที่คลองละอุ่นไหลลงแม่น้ำกระบุรี
                              และอ่าวที่กั้นระหว่างจังหวัดระนองกับเมียนมาร์ ยอดเขาฝาชีนั้นเป็นสถานที่ชมวิวที่งดงาม โดยเฉพาะยามตะวันลับฟ้าในตอนเย็น</p>
                              <a href="ecosystem.php?id=30">MORE</a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



<div class="wrapper_content_ranong" >
      <div class="container" style="margin: auto;text-align: center;">
        <div class="row">
        <div class="col-12 col-md-4 col-lg-4"></div>
        <div class="col-12 col-md-5 col-lg-5">
        <a href="mapall.php"><img src="assets/img/all/mapall.png" alt="" style="width:200px;"></a>
        
        </div>
        </div>
</div>


      <div class="container" style="margin: auto;text-align: center;">
        <p style="font-size:2.8em;"><i class="fa fa-download"></i> ดาวน์โหลดแอปพลิเคชัน</p>
        <div class="row">
        <div class="col-12 col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-5 col-lg-4"><br>
        <a href="https://itunes.apple.com/us/app/%E0%B8%A3-%E0%B8%81-%E0%B8%93-%E0%B8%A3%E0%B8%B0%E0%B8%99%E0%B8%AD%E0%B8%87/id1351250082?ls=1&mt=8"><img src="./assets/img/all/appstore.png" style="height:80px;" class="center"></a><br>
        <a href="https://play.google.com/store/apps/details?id=th.go.ranong.loveranong&hl=th"><img src="./assets/img/all/playstore.png" style="height:80px;" class="center"></a><br>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
        <a href="loadapp.html"><img src="./assets/img/all/qr_code.jpg" style="width:220px;"></a>
        </div>
        <div class="col-12 col-md-1 col-lg-2"></div>
        </div>
            </div>






        <div class="footer">
          <h2>LOVE NA RANONG <a href="admin" title="จัดการระบบ"><span class="fa fa-user-circle" style="font-size:0.8em;"></span></a></h2>
        </div>

<script>
  /*
  var currentYear=parstInt(new Date().getFullYear());
  $("#dateStart").datepicker({
    yearSuffix: "<span class=\"ui-datepicker-year custom-datepicker-year\">" + (currentYear + 543) + "</span>",
    onChangeMonthYear: function(yr, dontCareAboutMonths, inst) {
        inst.settings.yearSuffix = "<span class=\"custom-datepicker-year\">" + (yr + 543) + "</span>";;
    }
  });
  */

  //$('#dateStart').datepicker({ format: "dd/mm/yyyy", autoclose: true , date-language:"th-th"});
  // Get the modal
  var modal = document.getElementById('id01');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
</script>


</body>
</html>
