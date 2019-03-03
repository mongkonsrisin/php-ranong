<!doctype html>
<html lang="en">
<head>
   <?php require_once('./headfood.php'); ?>
   <?php require_once('./db_config.php') ?>

   
</head>

<body>
    <!-- nav -->
    <?php require_once('./navbar.php'); ?>
    <!-- end nav -->

    <?php
        $cat=3;
        $sql = "SELECT * FROM tbl_poi p left join tbl_subdistrict s on (p.poi_subdistrict = s.sub_id) left join tbl_district d  on(s.sub_amid=d.dis_id and s.sub_proid=d.dis_proid) left join tbl_province v on(s.sub_proid=v.pro_geocode) WHERE poi_cat=$cat AND poi_id=".$_GET['id'];
        $result = mysqli_query($con,$sql);
        $found = mysqli_num_rows($result);
        
        if($found == 0) {
            echo '<meta http-equiv="refresh" content="0;url=poi.php?cat=3">';
            exit();
        }
        $row = mysqli_fetch_assoc($result);
        //1.เพิ่ม banner
        $banner = "assets/img/poi/m/".$_GET['id'].".png";
    ?>

    <!-- section1 -->
    <div style="margin-top:100px;" class="d-none d-lg-block" >
        <div class="row">
            <div class="col-sm-8">
            <a class="bold border" style="color:#fff;margin-left:230px;z-index:5;position:absolute;float:left;"><?=$row['poi_name'] ?></a>

            
           <?php
           //2.php
           if(file_exists($banner))
           echo '<img src="'.$banner.'?cache=none" width="30%" id="banner">';
            ?>

            <div id="name" style="font-size:1.2em;"><?php if(!empty($row['poi_housenumber'])) { ?> บ้านเลขที่ <?=$row['poi_housenumber']; } ?> <?php if(!empty($row['poi_moo'])) { ?> หมู่<?=$row['poi_moo']; }?><?php if(!empty($row['poi_alley'])) { ?> ซอย <?=$row['poi_alley']; }?>
                <br><?php if(!empty($row['poi_street'])) { ?> ถนน <?=$row['poi_street']; }?> <?php if(!empty($row['sub_thainame'])) { ?>ตำบล <?=$row['sub_thainame']; }?> 
                <?php if(!empty($row['dis_thainame'])) { ?>อำเภอ <?=$row['dis_thainame']; }?><?php if(!empty($row['pro_thainame'])) { ?> จังหวัด <?=$row['pro_thainame']; }?>
                <br><?php if(!empty($row['poi_zipcode'])) { ?> รหัสไปรษณีย์ <?=$row['poi_zipcode']; }?>
            </div>
            </div>

            <div class="col-sm-4 d-none d-lg-block" align="right" style="margin-right:0px;margin-top:20px">

<?php
$pic = 'assets/img/food/ribbon'.$_GET['id'].'.png';
        
if (file_exists($pic)) {
  ?>
  <img src='<?=$pic?>'>
  <?php
} else {
    ?><img src="assets/img/food/ribbon.png"><?php
}


?>


            </div>
        </div>
    </div>
    <!-- end section1 -->

    <!-- section1 onmobile -->
    <!-- เพิ่ม top -->
    <div style="margin-top:150px;" class="d-lg-none">
        <div class="row">
            <div class="col-12" align="center">
                <div class="bold2 border2" style="color:#fff;z-index:100;margin-right:10px;margin-left:10px;font-size:1.5em;"><?=$row['poi_name'] ?></div>
            </div>
            
            <div class="col-12" align="center"  style="font-size:1.1em;">
                <?php if(!empty($row['poi_housenumber'])) { ?> บ้านเลขที่ <?=$row['poi_housenumber']; } ?> <?php if(!empty($row['poi_moo'])) { ?> หมู่<?=$row['poi_moo']; }?><?php if(!empty($row['poi_alley'])) { ?> ซอย <?=$row['poi_alley']; }?>
                <?php if(!empty($row['poi_street'])) { ?> ถนน <?=$row['poi_street']; }?> <br><?php if(!empty($row['sub_thainame'])) { ?>ตำบล <?=$row['sub_thainame']; }?> 
                <?php if(!empty($row['dis_thainame'])) { ?>อำเภอ <?=$row['dis_thainame']; }?><?php if(!empty($row['pro_thainame'])) { ?> จังหวัด <?=$row['pro_thainame']; }?>
                <?php if(!empty($row['poi_zipcode'])) { ?> รหัสไปรษณีย์ <?=$row['poi_zipcode']; }?>
            </div>
            </div>

            <?php
            //3.php
                if(file_exists($banner)){
                echo '<div class="col-12" align="center">';
                echo '<img class="imgshop" src="'.$banner.'?cache=none" width="30%">';
                echo '</div>';
                }
            ?>

        </div>
    </div>
    <!-- end section1 onmobile-->
    
    <!-- section2 -->
    <div class="container d-none d-lg-block" style="margin-top:170px;">
        <div class="row" align="center">
            <?php
                $directory = "assets/img/food/".$_GET['id']."/";// dir location
                $sql2 = "SELECT * FROM tbl_food WHERE fd_poiid=".$_GET['id'] ." AND fd_show=1";
                $result2 = mysqli_query($con,$sql2);
                $filecount = mysqli_num_rows($result2);
                if($filecount > 0){
                    $col = 12/$filecount;
                    while($row2 = mysqli_fetch_assoc($result2)){
                        $price = $row2['fd_price'];
                        $foodname = $row2['fd_name'];
                        echo '<div class="col-sm-'.$col.'">';
                        //เพิ่ม
                        echo '<img src="'.$directory.$row2['fd_id'].'.png" class="zoom" width="100%">';
                        echo '<div class="font" style="font-size:1.2em;">'.$foodname.'<span>&nbsp;'.$price.' บาท</span></div>';
                        echo '</div>';
                    }
                }
                else{//"ไม่มีข้อมูล tbl_food
                    $allpics = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
                    if ($allpics != false)
                    {
                        $filecount = count($allpics);
                        $col = 12/$filecount;
                        //  echo "There are : ".$filecount." files<br><br>";
                        for($i=0;$i<$filecount;$i++)
                        {  
                            echo '<div class="col-sm-'.$col.'">';
                            echo '<img src="'.$allpics[$i].'" class="zoom" width="100%">';
                            echo '</div>';
                        }
                    }
                }
            ?>
        </div>
    </div>
    <!-- end section2 -->

    <!-- section2 onmobile -->
    <div class="container d-lg-none" style="margin-top:100px;">
        <div class="row" align="center">
            <?php
                $directory = "assets/img/food/".$_GET['id']."/";// dir location
                $sql2 = "SELECT * FROM tbl_food WHERE fd_poiid=".$_GET['id'] ." AND fd_show=1";;
                $result2 = mysqli_query($con,$sql2);
                $filecount = mysqli_num_rows($result2);
                if($filecount > 0){
                    $col = 12/$filecount;
                    while($row2 = mysqli_fetch_assoc($result2)){
                        $price = $row2['fd_price'];
                        $foodname = $row2['fd_name'];
                        echo '<div class="col-lg-'.$col.'">';
                        //เพิ่ม
                        echo '<img src="'.$directory.$row2['fd_id'].'.png" class="zoom" width="100%">';
                        echo '<div class="font"style="font-size:1.2em;">'.$foodname.'<span style="margin-left:40px;">'.$price.' บาท</span></div>';
                        echo '</div>';
                    }
                }
                else{//"ไม่มีข้อมูล tbl_food
                    $allpics = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
                    if ($allpics != false)
                    {
                        $filecount = count($allpics);
                        $col = 12/$filecount;
                        //  echo "There are : ".$filecount." files<br><br>";
                        for($i=0;$i<$filecount;$i++)
                        {  
                            echo '<div class="col-lg-'.$col.'">';
                            echo '<img src="'.$allpics[$i].'" class="zoom" width="100%">';
                            echo '</div>';
                        }
                    }
                }
            ?>
        </div>
    </div>

    

 
</div>

    <div class="container-fluid" align="right">
        <p>
            <button class="btn btn-5 btn-5a icon-cart" onclick="window.location.href='gallery.php?id=<?=$_GET['id']?>&back=food'"><a>Gallery</a></button>
        </p>
    </div>


 <?php require_once('./footer.php'); ?>


</body>
</html>