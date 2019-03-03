 <?php require_once('db_config.php'); ?> 
<!DOCTYPE html>
<link rel="shortcut icon" href="assets/img/all/icon.ico">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Keywords" content="ระนอง, ranong, รักนะระนอง, ท่องเที่ยว, สินค้าชุมชน, โปรแกรมท่องเที่ยว, travel, เชิงนิเวศ, เชิงสุขภาพ, ทะเล, เที่ยวไทย, ภาคใต้">
  <meta name="Description" content="'รักนะระนอง (Love at Ranong)' แอปพลิเคชันแนะนำสถานที่ท่องเที่ยว ที่พัก ร้านอาหาร ร้านค้าหรือแหล่งจำหน่ายสินค้าชุมชน/สินค้าหนึ่งตำบลหนึ่งผลิตภัณฑ์ที่นักท่องเที่ยวนักเดินทางไม่ควรพลาด สำหรับที่จะใช้เวลาพักผ่อนไปในจังหวัดระนอง ซึ่งจะมีโปรแกรมท่องเที่ยวแนะนำที่ช่วยวางแผนการเดินทาง และให้นักท่องเที่ยวประมาณการงบประมาณค่าใช้จ่ายและระยะเวลาที่จะใช้ในการท่องเที่ยวในทริปหนึ่งได้ 
ทั้งนี้ระบบจะแสดงแผนที่กูเกิ้ล เพื่อให้ท่านสามารถเดินทางไปยังจุดหมายที่แนะนำในจังหวัดระนองในรูปแบบของการท่องเที่ยวเชิงนิเวศ และการท่องเที่ยวเชิงสุขภาพ รวมทั้งแสดงรายละเอียดและข้อมูลติดต่อสถานที่ท่องเที่ยว ที่พัก ร้านอาหารและแหล่งจำหน่ายสินค้าอีกด้วย
'รักท่องเที่ยว รักธรรมชาติ รักระนอง' ระนอง เป็นจังหวัดชายฝั่งทะเลด้านตะวันตกในภาคใต้ของประเทศไทย มีพื้นที่ประมาณ 2 ล้านไร่ ทิศตะวันตกติดกับทะเลอันดามันและประเทศเมียนมาร์ซึ่งครอบคลุมไปถึงทิศเหนือ ทิศตะวันออกติดกับจังหวัดชุมพร ส่วนทิศใต้ติดกับจังหวัดพังงาและสุราษฏร์ธานี แหล่งท่องเที่ยวที่นิยมในระนองจะมีน้ำตกและบ่อน้ำร้อนหลายแห่ง ให้นักท่องเที่ยวได้มาอาบน้ำแร่ธรรมชาติได้ตามอัธยาศัย">
    <title>รักนะระนอง</title>
    <link rel="stylesheet" href="./assets/css/navbar.css">
    <link rel="stylesheet" href="./assets/fonts/font.css">
    <link rel="stylesheet" href="assets/css/package_bootstrap.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/package_global.css">
    <link rel="stylesheet" href="assets/css/package05.css">
    <link rel="stylesheet" href="assets/css/responsive5.css"> 
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <!-- script code -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/fontawesome-all.js"></script>
    <!-- slick -->
    <link rel="stylesheet" href="assets/source_slickslide/slick-theme.css" media="screen">
    <link rel="stylesheet" href="assets/source_slickslide/slick.css" media="screen">
    <!-- js slick -->
    <script src="assets/source_slickslide/slick.js"></script>
</head>
<body style="background-color:#97d1f1;">
    <!-- nav -->
 <?php require_once('./navbar.php')?>
  <!-- end nav -->
    <div class="packgatemobile">
    <div class="backgroundpackgate-mobile" style="margin-top:30px;">
            <div class="test">
            <div class="detail-event">
            <div class="row">
                    <div class="col-md-12">
                    <div class="detail-packgate-mobile">
                        <p style="font-size: 2em;text-align: center    ;background-color:rgba(169, 199, 157, 0.7411764705882353);"> รายการท่องเที่ยว </p>
                            <p style="font-size: 1em;">
                            <?php 
                                $i = 1;
                                $sql = "SELECT * FROM tbl_package WHERE pk_id=5";
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_assoc($result);
                                $poiArray = array();
                                $poiArray = explode('|',$row['pk_route']);
                                $poiName = array();
                                $actdetail = array();                              

                                foreach ($poiArray as $poi) {
                                $sql = "SELECT * FROM tbl_poi WHERE poi_id=$poi";
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_assoc($result);
                                $poiName[$i]=$row['poi_name'];

                                $sql2 = "SELECT * FROM tbl_activity WHERE act_poiid=$poi";
                                $result2 = mysqli_query($con,$sql2);
                                $foundact = mysqli_num_rows($result2);
                                $actdetail['detail'][$i] = $actdetail['time'][$i] = $actpic='';
                                if ($foundact>0){
                                $row2 = mysqli_fetch_assoc($result2);
                                $actpic = '<img src="assets/img/package/icon/'.$row2['act_icon'].'.png" style="width:30px;">';
                                $actdetail['detail'][$i]=$row2['act_detail'];
                                $actdetail['time'][$i]=$row2['act_time'];
                                }
                                

                                 if($i > 1) {
                                echo '&nbsp;';
                                echo ($i-1).'.';
                                echo '&nbsp;';
                                echo $row['poi_name'].' '.$actpic;
                                echo '<br>';
                                    }
                                $i++;
                                }
                            ?>
                        </p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- รูป mb อันแรก -->
                    <div class="col-md-12">
                        <div class="road-mobile"> 
                        <img src="assets/img/package/5/t_roadpackget5_01test.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:40px;">
                    <div class="col-md-12">
                        <div class="packgate-left-mobile">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/1-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/1-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/1-3.png" alt="">
                                </div>
                            </div>
                            <h2> <img src="assets/img/package/5/04.png" alt="" class="num"> <?=$poiName[5]?></h2>
                            <p style="font-size: 1.5em;">กิจกรรม :<?=$actdetail['detail'][5]?></p>
                            <p style="font-size: 1.5em;">ระยะเวลา :<?=$actdetail['time'][5]?> นาที</p>
                        </div>
                    </div>
                </div>

                <!-- สุดหล่อเพิ่ม mobile -->
                <div class="row" style="margin-bottom:40px;">
                    <div class="col-md-12">
                        <div class="packgate-left-mobile">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/2-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/2-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/2-3.png" alt="">
                                </div>
                            </div>
                            <h2> <img src="assets/img/package/5/09.png" alt="" class="num"> <?=$poiName[10]?></h2>
                            <p style="font-size: 1.5em;">กิจกรรม :<?=$actdetail['detail'][10]?></p>
                            <p style="font-size: 1.5em;">ระยะเวลา :<?=$actdetail['time'][10]?> นาที</p>
                        </div>
                    </div>
                </div>
                <!-- สุดหล่อเพิ่ม -->
                
                
                
            </div>
        </div>
    </div>
    <div class="packgate">
        <div class="backgroundpackgate" style="margin-top:85px;">
            
            <div class="test">
            <div class="detail-event">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="packgate-left"> 
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/1-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/1-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/1-3.png" alt="">
                                </div>
                            </div>
                            <h3 style="font-size: 1.1em;"> <img src="assets/img/package/5/04.png" alt="" class="num">&nbsp;<?=$poiName[5]?></h3>
                            <p style="font-size: 1em;">กิจกรรม :<?=$actdetail['detail'][5]?></p>
                            <p style="font-size: 1em;">ระยะเวลา :<?=$actdetail['time'][5]?> นาที</p>
                        </div>
                    </div>
                </div>                
            </div>   

            <!-- สุดหล่อเพิ่ม pc  -->
            <div class="test">
            <div class="detail-event">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="packgate-left" style="margin-top:10px;"> 
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/2-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/2-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/5/slide/2-3.png" alt="">
                                </div>
                            </div>
                            <h3 style="font-size: 1.1em;"> <img src="assets/img/package/5/09.png" alt="" class="num">&nbsp;<?=$poiName[10]?></h3>
                            <p style="font-size: 1em;">กิจกรรม :<?=$actdetail['detail'][10]?></p>
                            <p style="font-size: 1em;">ระยะเวลา :<?=$actdetail['time'][10]?> นาที</p>
                        </div>
                    </div>
                </div>                
            </div>   
            <!-- สุดหล่อเพิ่ม pc  -->
            
        </div>
    </div>
     
   
    <div class="packgate">
            <div class="detail-event">
                <div class="row">
                    <div class="col-md-6">
                    <div class="detail-packgate">
                        <p style="font-size: 30px;text-align: center ;background-color:rgba(169, 199, 157, 0.7411764705882353); "> รายการท่องเที่ยว </p>
                            <p style="font-size: 27px;">
                            <?php 
                                $i = 1;
                                $sql = "SELECT * FROM tbl_package WHERE pk_id=5";
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_assoc($result);
                                $poiArray = array();
                                $poiArray = explode('|',$row['pk_route']);
                                $poiName = array();
                                $actdetail = array();                              

                                foreach ($poiArray as $poi) {
                                $sql = "SELECT * FROM tbl_poi WHERE poi_id=$poi";
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_assoc($result);
                                $poiName[$i]=$row['poi_name'];

                                $sql2 = "SELECT * FROM tbl_activity WHERE act_poiid=$poi";
                                $result2 = mysqli_query($con,$sql2);
                                $foundact = mysqli_num_rows($result2);
                                $actdetail['detail'][$i] = $actdetail['time'][$i] = $actpic='';
                                if ($foundact>0){
                                $row2 = mysqli_fetch_assoc($result2);
                                $actpic = '<img src="assets/img/package/icon/'.$row2['act_icon'].'.png" style="width:30px;">';
                                $actdetail['detail'][$i]=$row2['act_detail'];
                                $actdetail['time'][$i]=$row2['act_time'];
                                }
                                

                                 if($i > 1) {
                                echo '&nbsp;';
                                echo ($i-1).'.';
                                echo '&nbsp;';
                                echo $row['poi_name'].' '.$actpic;
                                echo '<br>';
                                    }
                                $i++;
                                }
                            ?>
                        </p>
                        </div>
                        </div>
                    </div>
                </div>
                
        </div>
        </div>
    </div>
    <?php require_once('./footer_package.php'); ?>
    <script>
        $('.single-item').slick({
            prevArrow:false,
            nextArrow:false,
            dots:true,
            autoplay:true,
            autoplaySpeed:2000
        });
    </script>
</body>
</html> 