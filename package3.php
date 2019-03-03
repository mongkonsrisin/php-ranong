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
    <link rel="stylesheet" href="assets/css/package03.css">
    <link rel="stylesheet" href="assets/css/responsive_packgate03.css">
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
        <div class="backgroundpackgate" style="margin-top:30px;">
            <div class="test">
            <div class="detail-event">
            <div class="row">
                    <div class="col-md-12">
                    <div class="detail-packgate-mobile">
                        <p style="font-size: 2em;text-align: center;background-color: rgba(169, 199, 157, 0.7411764705882353);"> รายการท่องเที่ยว </p>
                            <p style="font-size: 0.9em;">
                            <?php 
                                $i = 1;
                                $sql = "SELECT * FROM tbl_package WHERE pk_id=3";
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
                    <div class="col-md-12">
                        <div class="road-mobile">
                        <img src="assets/img/package/2/t_roadpackget2_01test.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="packgate-left-mobile">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/1-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/1-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/1-3.png" alt="">
                                </div>
                            </div>
                            <h1> <img src="assets/img/package/3/05.png" alt="" class="num"> <?=$poiName[6]?></h1>
                            <p style="font-size:1.6em;">กิจกรรม: <?=$actdetail['detail'][6]?></p>
                            <p style="font-size:1.6em;">เวลา: <?=$actdetail['time'][6]?> นาที</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="packgate-left-mobile">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/4-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/4-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/4-3.png" alt="">
                                </div>
                            </div>
                            <h1> <img src="assets/img/package/3/06.png" alt="" class="num"> <?=$poiName[7]?></h1>
                            <p style="font-size:1.6em;">กิจกรรม: <?=$actdetail['detail'][7]?></p>
                            <p style="font-size:1.6em;">เวลา: <?=$actdetail['time'][7]?> นาที</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="road-mobile">
                            <img src="assets/img/package/3/t_packget3_02.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="packgate-right2-mobile" >
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/2-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/2-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/2-3.png" alt="">
                                </div>
                            </div>
                            <h1><img src="assets/img/package/3/16.png" alt="" class="num"> <?=$poiName[17]?></h1>
                            <p style="font-size:1em;">กิจกรรม: <?=$actdetail['detail'][17]?></p>
                            <p style="font-size:1em;">เวลา: <?=$actdetail['time'][17]?> นาที</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="road-mobile">
                            <img src="assets/img/package/3/t_packget3_03.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="packgate-right3-mobile" >
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/3-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/3-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/3-3.png" alt="">
                                </div>
                            </div>
                            <h1><img src="assets/img/package/3/21.png" alt="" class="num"> <?=$poiName[22]?></h1>
                            <p style="font-size:1em;">กิจกรรม: <?=$actdetail['detail'][22]?></p>
                            <p style="font-size:1em;">เวลา: <?=$actdetail['time'][22]?> นาที</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="packgate">
        <div class="backgroundpackgate1" style="margin-top:85px;">
       
            <div class="detail-event">
                <div class="row">
                <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="packgate-left">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/1-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/1-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/1-3.png" alt="">
                                </div>
                            </div>
                            <h3 style="font-size:33px;"> <img src="assets/img/package/3/05.png" alt="" class="num"> <?=$poiName[6]?></h3>
                            <p style="font-size:1em;">กิจกรรม: <?=$actdetail['detail'][6]?></p>
                            <p style="font-size:1em;">เวลา: <?=$actdetail['time'][6]?> นาที</p>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="packgate-left">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/4-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/4-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/4-3.png" alt="">
                                </div>
                            </div>
                            <h3 style="font-size:33px;"> <img src="assets/img/package/3/06.png" alt="" class="num"> <?=$poiName[7]?></h3>
                            <p style="font-size:1em;">กิจกรรม: <?=$actdetail['detail'][7]?></p>
                            <p style="font-size:1em;">เวลา: <?=$actdetail['time'][7]?> นาที</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="packgate2">
        <div class="backgroundpackgate2">
            <div class="detail-event">
                <div class="row">
                <div class="col-md-6">
                    <div class="detail-packgate">
                    <p style="font-size: 30px;text-align: center;background-color: rgba(169, 199, 157, 0.7411764705882353);"> รายการท่องเที่ยว </p>
                            <p style="font-size: 1em;"> 
                            <?php 
                                $i = 1;
                                $sql = "SELECT * FROM tbl_package WHERE pk_id=3";
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
                    <div class="col-md-6">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="packgate-right2">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/2-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/2-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/2-3.png" alt="">
                                </div>
                            </div>
                            <h3 style="font-size:33px;"><img src="assets/img/package/3/16.png" alt="" class="num"> <?=$poiName[17]?></h3>
                            <p style="font-size:1em;">กิจกรรม: <?=$actdetail['detail'][17]?></p>
                            <p style="font-size:1em;">เวลา: <?=$actdetail['time'][17]?> นาที</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="packgate3">
        <div class="backgroundpackgate3">
            <div class="detail-event">
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="packgate-right3">
                            <div class="single-item imgslide">
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/3-1.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/3-2.png" alt="">
                                </div>
                                <div class="img_layout">
                                    <img src="assets/img/package/3/slide/3-3.png" alt="">
                                </div>
                            </div>
                            <h3 style="font-size:33px;"><img src="assets/img/package/3/21.png" alt="" class="num"> <?=$poiName[22]?></h3>
                            <p style="font-size:1em;">กิจกรรม: <?=$actdetail['detail'][22]?></p>
                            <p style="font-size:1em;">เวลา: <?=$actdetail['time'][22]?> นาที</p>
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