<!doctype html>
<html lang="en">
<head>
<?php require_once('./db_config.php') ?>
   
<?php require_once('./headhotel.php'); ?>
 
<?php
//check image
$id = $_GET['id'];
$url1 = "assets/img/banner/$id/left1.png";
$url2 = "assets/img/banner/$id/left2.png";
$url3 = "assets/img/banner/$id/slide1.png";
$url4 = "assets/img/banner/$id/slide2.png";
$url5 = "assets/img/banner/$id/slide3.png";

if(!file_exists($url1) || !file_exists($url2) || !file_exists($url3) || !file_exists($url4) || !file_exists($url5)) {
    echo '<meta http-equiv="refresh" content="0;url=poi.php?cat=2&type=2">';
            exit();
}




?>

</head>

<body>
    <!-- nav -->
    <?php require_once('./navbar.php')?>
    <!-- end nav -->

    <!-- php -->
    <?php
    $cat=2;
    $type=1;
        $sql = "SELECT * FROM tbl_poi  p left join tbl_subdistrict s on (p.poi_subdistrict = s.sub_id) left join tbl_district d  on(s.sub_amid=d.dis_id and s.sub_proid=d.dis_proid) left join tbl_province v on(s.sub_proid=v.pro_geocode)WHERE poi_cat=$cat AND poi_type=$type AND poi_id=".$_GET['id'];
        $result = mysqli_query($con,$sql);
        $found = mysqli_num_rows($result);
        if($found == 0) {
            echo '<meta http-equiv="refresh" content="0;url=poi.php?cat=2&type=1">';
            exit();
        }
        $row = mysqli_fetch_assoc($result);

    ?>

    <!-- section1 left -->
    <div class="container" style="margin-top:100px">
        <div class="row back" >
            <div class="col-sm-4 head d-none d-lg-block" align="center" style="padding-right:0;padding-left:0px;background-color:transparent;;background-size:cover;color:#fff;">
            
                <div style="height:100%">
                    <div class="head_1">
                        <h2 class="center" ><?=$row['poi_name'] ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 headtext d-none d-lg-block" align="center" style="background:transparent;">
    
                <div class="center" style="position:relative;">
                    <a style="font-size:1em;color:#E8F5E9; ">  
                    <?php if(!empty($row['poi_housenumber'])) { ?> บ้านเลขที่ <?=$row['poi_housenumber']; } ?>
                    <?php if(!empty($row['poi_poi_moo'])) { ?> หมู่ <?=$row['poi_poi_moo']; } ?>
                    <?php if(!empty($row['sub_thainame'])) { ?> ตำบล <?=$row['sub_thainame']; } ?>
                    <?php if(!empty($row['dis_thainame'])) { ?> อำเภอ <?=$row['dis_thainame']; } ?>
                    <?php if(!empty($row['pro_thainame'])) { ?> จังหวัด <?=$row['pro_thainame']; } ?>
                    <?php if(!empty($row['poi_zipcode'])) { ?> รหัสไปรษณีย์ <?=$row['poi_zipcode']; } ?>
                    
                    </a>
                </div>
            </div>

            <!-- section1 right -->



            <div class="col-sm-4 lamp  d-none d-lg-block" style="padding-right:0;padding-left:0;">
                <div  align="right" style=" margin-right:25px;">

                    <?php if (!empty($row['poi_website'])) {?>
                    <div class="col-1 d-none d-lg-block" align="right" style="margin:5px 0px 0px 0px;">
                        <a href="<?=$row['poi_website'] ?>" data-toggle="tooltip" data-placement="top" title="<?=$row['poi_website'] ?>" class="social-round-icon white-round-icon fa-icon d-none d-sm-block d-md-none d-xl-block" style="<?php if (empty($row['poi_website'])) {?>background-color:rgba(122, 24, 29,0.6);<?php } ?>">
                        <i class="fa fa-globe" style="color:#fff;"></i></a>
                    </div>
                    <?php } ?>

                    <?php if (!empty($row['poi_facebook'])) {?>
                    <div class="col-1 d-none d-lg-block" style="margin:5px 0px 0px 0px;">
                        <a href="#" data-toggle="tooltip" title="<?=$row['poi_facebook'] ?>" class="social-round-icon white-round-icon fa-icon d-none d-sm-block d-md-none d-xl-block" style="<?php if (empty($row['poi_facebook'])) {?>background-color:rgba(122, 24, 29,0.6);<?php } ?>">
                    <i class="fab fa-facebook-f" style="color:#fff;"></i></a>
                    </div>
                    <?php } ?>

                    <?php if (!empty($row['poi_line'])) {?>
                    <div class="col-1 d-none d-lg-block" style="margin:5px 0px 0px 0px;">
                        <a href="#" data-toggle="tooltip" title="<?=$row['poi_line'] ?>" class="social-round-icon white-round-icon fa-icon d-none d-sm-block d-md-none d-xl-block" style="<?php if (empty($row['poi_line'])) {?>background-color:rgba(122, 24, 29,0.6);<?php } ?>">
                        <i class="fab fa-line" style="color:#fff;"></i></a>
                    </div>
                    <?php } ?>

                    <?php if (!empty($row['poi_phone'])) {?>
                    <div class="col-1 d-none d-lg-block" style="margin:5px 0px 0px 0px;">
                        <a href="#" data-toggle="tooltip" title="Tel: <?=$row['poi_phone'] ?>" class="social-round-icon white-round-icon fa-icon d-none d-sm-block d-md-none d-xl-block" style="<?php if (empty($row['poi_phone'])) {?>background-color:rgba(122, 24, 29,0.6);<?php } ?>">
                        <i class="fas fa-phone" style="color:#fff;"></i></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- section1 left onmobile -->
        <div class="row hidden-xs-up back">
            <div class="col-lg-6 head d-lg-none" align="center" style="padding-right:0;padding-left:0px;background-image: transparent;background-size:cover;color:#fff;">
                
                <div class="d-lg-none" style="height:100%;">
                    <div style="position:relative;">
                        <h2 class="center2"><?=$row['poi_name'] ?></h2>
                    </div>
                </div>
            </div>

            <!-- section1 right onmobile -->
            <div class="col-lg-6 headtext d-lg-none" align="center" style="padding-right:0;padding-left:0;background-color:transparent; color:#fff;">
                <div class="center2" style="position:relative;">
                <?php if(!empty($row['poi_housenumber'])) { ?> บ้านเลขที่ <?=$row['poi_housenumber']; } ?>
                <?php if(!empty($row['poi_poi_moo'])) { ?> หมู่ <?=$row['poi_poi_moo']; } ?>
                <?php if(!empty($row['sub_thainame'])) { ?> ตำบล <?=$row['sub_thainame']; } ?>
                <?php if(!empty($row['dis_thainame'])) { ?> อำเภอ <?=$row['dis_thainame']; } ?>
                <?php if(!empty($row['pro_thainame'])) { ?> จังหวัด <?=$row['pro_thainame']; } ?>
                <?php if(!empty($row['poi_zipcode'])) { ?> รหัสไปรษณีย์ <?=$row['poi_zipcode']; } ?>
                </div>
            </div>
        </div>

        <!-- section2 left -->
        <div class="row">
            <div class="col-lg-4 d-lg-none d-xl-block" style="padding:0px 0px 0px 0px;">
                <div class="imgleft1-wrapper">
                    <div class="overlay">
                    </div>
                    <div class="imgleft1" align="center">
                        <a href="./assets/img/banner/<?=$row['poi_id'] ?>/left1.png" data-lightbox="img1" >
                        <img src="./assets/img/banner/<?=$row['poi_id'] ?>/left1.png" width="393.50px">
                        </a>
                    </div>
                </div>
          
                <div class="imgleft2-wrapper">
                    <div class="overlay2">
                    </div>
                    <div class="imgleft2" align="center">
                        <a href="./assets/img/banner/<?=$row['poi_id'] ?>/left2.png " data-lightbox="img2">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/left2.png" width="393.50">
                        </a>
                    </div>
                </div>
            </div>
        
            <!-- section2 right -->
            
            <div class="col-lg-8 d-lg-none d-xl-block" style="background:#ffffff;padding:0px 0px 0px 0px;">
                <div id="demo" class="carousel slide"  data-ride="carousel">
                    <div class="test">
                    </div>
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active" style="border-radius:50%;width:15px;height:15px"></li>
                        <li data-target="#demo" data-slide-to="1" style="border-radius:50%;width:15px;height:15px"></li>
                        <li data-target="#demo" data-slide-to="2" style="border-radius:50%;width:15px;height:15px"></li>
                    </ul>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/slide1.png" width="100%" height="400">
                        </div>

                        <div class="carousel-item">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/slide2.png" width="100%" height="400">
                        </div>

                        <div class="carousel-item">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/slide3.png" width="100%" height="400">
                        </div>
                    </div>
                </div>
            </div>
        </div>


            
       
        
        <!-- section2 left onmobile -->
        <div class="row">
            <div class="col-lg-12 d-none d-lg-block d-xl-none" style="padding-right:0px;padding-left:0px;">
                <div class="imgleft1-wrapper">
                    <div class="overlay">
                    </div>
                    <div class="imgleft1" align="center">
                        <a href="assets/img/banner<?=$row['poi_id'] ?>/left1.png" data-lightbox="img1" >
                        <img src="assets/img/banner<?=$row['poi_id'] ?>/left1.png" width="400">
                        </a>
                    </div>
                </div>
            </div>
    
    
            <div class="col-lg-12 d-none d-lg-block d-xl-none" style="padding:0px 0px 0px 0px;">
          
                <div class="imgleft2-wrapper">
                    <div class="overlay2">
                    </div>
                    <div class="imgleft2" align="center">
                        <a href="./assets/img/banner/<?=$row['poi_id'] ?>/left2.png" data-lightbox="img2">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/left2.png" width="400">
                        </a>
                    </div>
                </div>
            </div>      
        
            <!-- section2 right onmobile-->
            
            <div class="col-lg-12 d-none d-lg-block d-xl-none" style="background:#ffffff;padding:0px 0px 0px 0px;">
                <div id="demo" class="carousel slide"  data-ride="carousel">
                    <div class="test">
                    </div>
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active" style="border-radius:50%;width:15px;height:15px"></li>
                        <li data-target="#demo" data-slide-to="1" style="border-radius:50%;width:15px;height:15px"></li>
                        <li data-target="#demo" data-slide-to="2" style="border-radius:50%;width:15px;height:15px"></li>
                    </ul>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/slide1.png" width="100%" height="400">
                        </div>

                        <div class="carousel-item">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/slide2.png" width="100%" height="400">
                        </div>

                        <div class="carousel-item">
                            <img src="./assets/img/banner/<?=$row['poi_id'] ?>/slide3.png" width="100%" height="400">
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>    
    </div>

        
            

</div>

</div>

    <!-- icon onmd -->
    <div class="container-fluid d-none d-lg-block d-md-block d-sm-block d-block d-xl-none" style="margin-top:10px;margin-bottom:10px;">
        <div class="container d-none d-lg-block d-md-block d-sm-block d-block d-xl-none">
            <div class="row hidden-sm-up">
                <?php 
                $sm = 0;
                if (!empty($row['poi_website'])) $sm++;
                if (!empty($row['poi_facebook'])) $sm++;
                if (!empty($row['poi_line'])) $sm++;
                if (!empty($row['poi_phone'])) $sm++;
                @$sm=12/$sm;
                ?>

                <?php if (!empty($row['poi_website'])) {?>
                <div class="col-sm-<?=$sm?> d-none d-lg-block d-md-block d-sm-block d-block d-xl-none" align="center" style="background-color:#FF8F00;height:100px;line-height:100px;">
                <a href="<?=$row['poi_website'] ?>" data-toggle="tooltip" data-placement="top" title="<?=$row['poi_website'] ?>">
                <img src="assets/img/all/webb.png" width="10%"></a>
                </div>
                <?php } ?>

                <?php if (!empty($row['poi_facebook'])) {?>
                <div class="col-sm-<?=$sm?> d-none d-lg-block d-md-block d-sm-block d-block d-xl-none" align="center" style="background-color:#475993;height:100px;line-height:100px;">
                <a href="#" data-toggle="tooltip" data-placement="top" title="<?=$row['poi_facebook'] ?>">
                <img src="assets/img/all/facebook.png" width="10%"></a>
                </div>
                <?php } ?>

                <?php if (!empty($row['poi_line'])) {?>
                <div class="col-sm-<?=$sm?> d-none d-lg-block d-md-block d-sm-block d-block d-xl-none" align="center" style="background-color:#00c300;height:100px;line-height:100px;">
                <a href="#" data-toggle="tooltip" data-placement="top" title="<?=$row['poi_line'] ?>">
                <img src="assets/img/all/line.png" width="10%"></a>
                </div>
                <?php } ?>

                <?php if (!empty($row['poi_phone'])) {?>
                <div class="col-sm-<?=$sm?> d-none d-lg-block d-md-block d-sm-block d-block d-xl-none" align="center" style="background-color:#2196F3;height:100px;line-height:100px;" id="phone2">
                <a href="tel:<?=$row['poi_housenumber'] ?>">
                <img src="assets/img/all/tel.png" width="10%"></a>
                </div>
                <?php } ?>


            </div>        
        </div>
    </div>
    
<!-- section3 -->
<?php if(!empty($row['poi_description'])) { ?>
    <div class="container-fluid d-none d-lg-block d-xl-none" style="margin-top:10px;margin-bottom:10px;;">
        <div class="container gradient-border d-none d-lg-block d-xl-none">    
            <div class="container" style="margin-top:10px;">
                <div class="row">
                <div class="col-<?=$x?>" align="center">
                        <p align="left" style="color:#000000;">
                        <?php echo $row['poi_description'] ?>
                        </p>
                    </div>
                </div>
            </div>    
          
        </div>
    </div>
        <?php } ?>
    <?php if(!empty($row['poi_description'])) { ?>
    <!-- section3 onmobile-->
    <div class="container-fluid d-lg-none d-xl-block" style="margin-top:10px;margin-bottom:10px;;">
        <div class="container gradient-border d-lg-none d-xl-block">    
            <div class="container" style="margin-top:10px;">
                <div class="row">
                <div class="col-<?=$x?>" align="center">
                        <p align="left" style="color:#000000;">
                        <?php echo $row['poi_description'] ?>
                        </p>
                    </div>
                    
                </div>
            </div>    
            
        </div>
    </div>
    <!-- end of section -->
    <?php } ?>

    <div class="container" align="right">
        <p>
            <button class="btn btn-block btn-5 btn-5a icon-cart" onclick="window.location.href='gallery.php?id=<?=$_GET['id']?>&back=ecosystem'"><a>Gallery</a></button>
        </p>
    </div>



    <!-- footer -->
    <?php require_once('./footer.php'); ?>
    <!-- enf of footer -->

    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

</body>
</html>