<!DOCTYPE html>
<html lang="en">
<head>

  <!-- css -->
  <?php require_once('./head.php') ?>

  <!-- database -->
  <?php require_once('./db_config.php') ?>
  <?php $cat = $_GET['cat'];
  $condition_sql=" poi_cat = $cat ";
  $next = "?cat=$cat";
  if(isset($_GET['type']) )
  { $type = $_GET['type'] ;
    $condition_sql.=" and poi_type = $type ";
    $next .= "&type=$type";
  }
  else
  $type = 0 ;

  if($cat == 1){
    $viewfile = "hotel.php";
    $titlepic = "bed.gif";
    if($type == 1){
      $titletxt = "ที่พักเชิงนิเวศ";
    }
    else if($type == 2){
      $titletxt = "ที่พักเชิงสุขภาพ";
    }
    else
    $titletxt = "ที่พัก";
  }
  else if($cat == 2){
    $viewfile = "ecosystem.php";
    $titlepic = "giphy.gif";
    if($type == 1){
      $viewfile = "ecosystem.php";
      $titletxt = "ท่องเที่ยวเชิงนิเวศ";
      $titlepic = "giphy.gif";
    }
    else if($type == 2){
      $viewfile = "healthy.php";
      $titletxt = "ท่องเที่ยวเชิงสุขภาพ";
      $titlepic = "bicycleday_dribbble2.gif";
    }
    else
    $titletxt = "สถานที่ท่องเที่ยว";
  }
  else if($cat == 3){
    $viewfile = "food.php";
    $titlepic = "food.gif";
    if($type == 1){
      $titletxt = "ร้านอาหารเชิงนิเวศ";
    }
    else if($type == 2){
      $titletxt = "ร้านอาหารเชิงสุขภาพ";
    }
    else
    $titletxt = "ร้านอาหาร";
  }
  else { //if($cat == 4){
    $viewfile = "otop.php";
    $titlepic = "icon_otop.png";
    $titletxt = "สินค้าชุมชน";
  }

  ?>



</head>

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-7243260-2']);
_gaq.push(['_trackPageview']);
(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})(
);

</script>

<style>
.title{position: absolute;color:#689F38;top:-2%}
.imgtitle{position: absolute;width:150px;top:-3%;}
.txttitle{position: absolute;top:-3%;left:130px;width:300px;}

@media (max-width: 575px){
.title{position: absolute;color:#689F38;top:-80px;}
.imgtitle{position: absolute;width:80px;top:0%;}
.txttitle{position: absolute;top:0%;left:80px;width:150px;}
}
</style>

<body>
  <!-- nav -->
  <?php require_once('./navbar.php')?>
  <!-- end nav -->

<?php require('map.php') ?>

<?php
    $search = $_GET['search'];
    $sqlsearch = "SELECT * FROM tbl_poi WHERE poi_show=1 AND (poi_name LIKE '%$search%') ";
    $resultsearch = mysqli_query($con,$sqlsearch);
    $searchpoi = mysqli_fetch_all($resultsearch,MYSQLI_ASSOC);
  ?>

  

  <?php
    $i = 1;
    foreach($searchpoi as $searchpoi) {
  ?>

<?php } ?>
  
  <span class="title"><img src="assets/img/all/<?=$titlepic?>" class="imgtitle"><h2 class="txttitle"><?=$titletxt?></h2></span>

<div class="d-none d-sm-block col-12" style="z-index:5;position:absolute;">
    <form action="poi.php" method="get" class="form-inline"  style="float:right;">
    <input type="hidden"   name="cat"  value="<?=$cat?>">
      <input type="text" class="form-control mb-2 mr-sm-1 mb-sm-0" name="search" placeholder="ค้นหาสถานที่..." value="<?=$search?>">
      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>
  </div>
  <!-- section left -->
  
  <?php

  $sql = "SELECT * FROM tbl_poi WHERE $condition_sql AND poi_lat!='' and poi_show=1 ";
  if(isset($_GET['search'])){
    $sql = "SELECT * FROM tbl_poi WHERE $condition_sql AND poi_show=1 AND (poi_name LIKE '%$search%') ";
  }
  $result = mysqli_query($con,$sql);
  $total = mysqli_num_rows($result);

  $sql = "SELECT * FROM tbl_poi WHERE $condition_sql AND poi_lat!='' and poi_show=1  ORDER BY RAND() LIMIT 0,12 ";
  if(isset($_GET['search'])){
    $sql = "SELECT * FROM tbl_poi WHERE $condition_sql AND poi_show=1 AND (poi_name LIKE '%$search%') ";
  }
  $result = mysqli_query($con,$sql);
  $n = mysqli_num_rows($result);
  $pic_info = array();
  for($i=0;$i<=12;$i++) {
    $pic_info[$i]['dnone'] = ' d-none';
  }
  $i = 0;
  while($row = mysqli_fetch_assoc( $result)) {

    $pic_info[$i]['text'] = $row['poi_name'];
    $pic_info[$i]['img'] = 'assets/img/poi/s/'.$row['poi_id'].'.png';
    $pic_info[$i]['lat'] = $row['poi_lat'];
    $pic_info[$i]['lng'] = $row['poi_lng'];
    $pic_info[$i]['dnone'] = '';
    $i++;
  }
  $poi_images = array(0,3,6,9,1,4,7,10,2,5,8,11);
  ?>


  <!-- section right Large-->
  <div class="col-8 d-none d-lg-block">
    <div id="content_right" >

      <div class="ooo" >

        <div class="row">
          <!--col1 -->
          <div class="col-sm-3" style="padding-right: 5px;padding-left: 5px;">
            <div class="hvrbox <?=$pic_info[$poi_images[0]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[0]]['lat']?>,<?=$pic_info[$poi_images[0]]['lng']?>,'<?=$pic_info[$poi_images[0]]['text']?>');">
              <a href=""><img src="<?=$pic_info[$poi_images[0]]['img']?>" class="picb" alt=""></a>
              <div class="hvrbox-layer_top hvrbox-layer_scale">
                <div class="hvrbox-text" style="font-size:1em;"><?=$pic_info[$poi_images[0]]['text']?></div>
              </div>
            </div>

            <div class="hvrbox <?=$pic_info[$poi_images[1]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[1]]['lat']?>,<?=$pic_info[$poi_images[1]]['lng']?>,'<?=$pic_info[$poi_images[1]]['text']?>');">
              <a href="">  <img src="<?=$pic_info[$poi_images[1]]['img']?>" class="picc"  alt=""> </a>
              <div class="hvrbox-layer_top hvrbox-layer_scale">
                <div class="hvrbox-text"><?=$pic_info[$poi_images[1]]['text']?></div>
              </div>
            </div>

            <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[2]]['lat']?>,<?=$pic_info[$poi_images[2]]['lng']?>,'<?=$pic_info[$poi_images[2]]['text']?>');">
              <div id="large-header" class="large-header <?=$pic_info[$poi_images[2]]['dnone']?>" style="background-image: url('<?=$pic_info[$poi_images[2]]['img']?>');" >
                <canvas id="demo-canvas"></canvas>
                <h1 class="main-title"><p class="border" style="font-size:0.5em;"><?=$pic_info[$poi_images[2]]['text']?></p> </h1></a>
              </div>
            </div>

            <!-- col2 -->
            <div class="col-sm-3 " style="padding-right: 5px;padding-left: 5px;">
              <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[3]]['lat']?>,<?=$pic_info[$poi_images[3]]['lng']?>,'<?=$pic_info[$poi_images[3]]['text']?>');"><div id="large-header2" class="large-header2 <?=$pic_info[$poi_images[3]]['dnone']?>" style="background-image: url('<?=$pic_info[$poi_images[3]]['img']?>');">
                <canvas id="demo-canvas2"></canvas>
                <h1 class="main-title" > <p class="border" style="font-size:0.5em;"><?=$pic_info[$poi_images[3]]['text']?></p> </span></h1>
              </div>


              <div class="hvrbox <?=$pic_info[$poi_images[4]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[4]]['lat']?>,<?=$pic_info[$poi_images[4]]['lng']?>,'<?=$pic_info[$poi_images[4]]['text']?>');">
                <a href="">  <img src="<?=$pic_info[$poi_images[4]]['img']?>" class="picc"  alt=""> </a>
                <div class="hvrbox-layer_top hvrbox-layer_scale">
                  <div class="hvrbox-text"><?=$pic_info[$poi_images[4]]['text']?></div>
                </div>
              </div>

              <div class="hvrbox <?=$pic_info[$poi_images[5]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[5]]['lat']?>,<?=$pic_info[$poi_images[5]]['lng']?>,'<?=$pic_info[$poi_images[5]]['text']?>');">
                <a href="">   <img src="<?=$pic_info[$poi_images[5]]['img']?>" class="picb " alt=""></a>
                <div class="hvrbox-layer_top hvrbox-layer_scale">
                  <div class="hvrbox-text"><?=$pic_info[$poi_images[5]]['text']?></div>
                </div>
              </div>

            </div>

            <!-- col3 -->
            <div class="col-sm-3" style="padding-right: 5px;padding-left: 5px;">
              <div class="hvrbox <?=$pic_info[$poi_images[6]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[6]]['lat']?>,<?=$pic_info[$poi_images[6]]['lng']?>,'<?=$pic_info[$poi_images[6]]['text']?>');">
                <a href="">   <img src="<?=$pic_info[$poi_images[6]]['img']?>" class="picb " alt=""></a>
                <div class="hvrbox-layer_top hvrbox-layer_scale">
                  <div class="hvrbox-text"><?=$pic_info[$poi_images[6]]['text']?></div>
                </div>
              </div>

              <div class="hvrbox <?=$pic_info[$poi_images[7]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[7]]['lat']?>,<?=$pic_info[$poi_images[7]]['lng']?>,'<?=$pic_info[$poi_images[7]]['text']?>');">
                <a href="">  <img src="<?=$pic_info[$poi_images[7]]['img']?>" class="picc"  alt=""> </a>
                <div class="hvrbox-layer_top hvrbox-layer_scale">
                  <div class="hvrbox-text"><?=$pic_info[$poi_images[7]]['text']?></div>
                </div>
              </div>

              <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[8]]['lat']?>,<?=$pic_info[$poi_images[8]]['lng']?>,'<?=$pic_info[$poi_images[8]]['text']?>');">
                <div id="large-header" class="large-header <?=$pic_info[$poi_images[8]]['dnone']?>" style="background-image: url('<?=$pic_info[$poi_images[8]]['img']?>');" >
                  <canvas id="demo-canvas"></canvas>
                  <h1 class="main-title"><p class="border" style="font-size:0.5em;"> <?=$pic_info[$poi_images[8]]['text']?></p> </h1></a>
                </div>
              </div>

              <!-- col4 -->

              <div class="col-sm-3" style="padding-right: 5px;padding-left: 5px;">

                <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[9]]['lat']?>,<?=$pic_info[$poi_images[9]]['lng']?>,'<?=$pic_info[$poi_images[9]]['text']?>');"><div id="large-header4" class="large-header4 <?=$pic_info[$poi_images[9]]['dnone']?>" style="background-image: url('<?=$pic_info[$poi_images[9]]['img']?>');" >
                  <canvas id="demo-canvas4"></canvas>
                  <h1 class="main-title"><p class="border" style="font-size:0.5em;"><?=$pic_info[$poi_images[9]]['text']?></p> </h1></h1>
                </div> </a>

                <div class="hvrbox <?=$pic_info[$poi_images[10]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[10]]['lat']?>,<?=$pic_info[$poi_images[10]]['lng']?>,'<?=$pic_info[$poi_images[10]]['text']?>');">
                  <a href="">   <img src="<?=$pic_info[$poi_images[10]]['img']?>" class="picb " alt=""></a>
                  <div class="hvrbox-layer_top hvrbox-layer_scale">
                    <div class="hvrbox-text"><?=$pic_info[$poi_images[10]]['text']?></div>
                  </div>
                </div>

                <div class="hvrbox <?=$pic_info[$poi_images[11]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[11]]['lat']?>,<?=$pic_info[$poi_images[11]]['lng']?>,'<?=$pic_info[$poi_images[11]]['text']?>');">
                  <a href="">  <img src="<?=$pic_info[$poi_images[11]]['img']?>" class="picc"  alt=""> </a>
                  <div class="hvrbox-layer_top hvrbox-layer_scale">
                    <div class="hvrbox-text"><?=$pic_info[$poi_images[11]]['text']?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- section right Large-->


<?php
    $search = $_GET['search'];
    $sqlsearch = "SELECT * FROM tbl_poi WHERE poi_show=1 AND (poi_name LIKE '%$search%') ";
    $resultsearch = mysqli_query($con,$sqlsearch);
    $searchpoi = mysqli_fetch_all($resultsearch,MYSQLI_ASSOC);
  ?>

  <div class="container d-block d-sm-none">
    <form action="poi.php" method="get" class="form-inline">
    <input type="hidden"  name="cat"  value="<?=$cat?>">
    
      <input type="text" class="form-control mb-2 mr-sm-1 mb-sm-0" name="search" placeholder="ค้นหาสถานที่..." value="<?=$search?>">
      <button type="submit" class="btn btn-primary container"><i class="fa fa-search"></i></button>
    </form>
  </div>

  <?php
    $i = 1;
    foreach($searchpoi as $searchpoi) {
  ?>

<?php } ?>

<!-- section right small-->
<div class="col-6 d-none d-sm-block d-lg-none">
  <div id="content_right" >

    <div class="ooo" >

      <div class="row">
        <!--col1 -->
        <div class="col-sm-12" style="padding-right: 5px;padding-left: 5px;">
          <div class="hvrbox <?=$pic_info[$poi_images[0]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[0]]['lat']?>,<?=$pic_info[$poi_images[0]]['lng']?>,'<?=$pic_info[$poi_images[0]]['text']?>');">
            <a href=""><img src="<?=$pic_info[$poi_images[0]]['img']?>" class="picb" alt=""></a>
            <div class="hvrbox-layer_top hvrbox-layer_scale">
              <div class="hvrbox-text" style="font-size:1em;"><?=$pic_info[$poi_images[0]]['text']?></div>
            </div>
          </div>

          <div class="hvrbox <?=$pic_info[$poi_images[1]]['dnone']?>" onclick="markerAnimate(<?=$pic_info[$poi_images[1]]['lat']?>,<?=$pic_info[$poi_images[1]]['lng']?>,'<?=$pic_info[$poi_images[1]]['text']?>');">
            <a href="">  <img src="<?=$pic_info[$poi_images[1]]['img']?>" class="picc"  alt=""> </a>
            <div class="hvrbox-layer_top hvrbox-layer_scale">
              <div class="hvrbox-text"><?=$pic_info[$poi_images[1]]['text']?></div>
            </div>
          </div>

          <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[2]]['lat']?>,<?=$pic_info[$poi_images[2]]['lng']?>,'<?=$pic_info[$poi_images[2]]['text']?>');">
            <div id="large-header" class="large-header <?=$pic_info[$poi_images[2]]['dnone']?>" style="background-image: url('<?=$pic_info[$poi_images[2]]['img']?>');" >
              <canvas id="demo-canvas"></canvas>
              <h1 class="main-title"><p class="border" style="font-size:0.5em;"><?=$pic_info[$poi_images[2]]['text']?></p> </h1></a>
            </div>
          </div>

          </div>
        </div>
      </div>
    </div>
<!-- section right small-->



<!-- section right small-->
<div class="col-12 d-block d-sm-none">
  <div id="content_right" >

    <div style="padding:20px;" >

      <div class="row">
					<!--col1 -->
					<div class="col-12" style="padding-right: 5px;padding-left: 5px;">
          
          <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[0]]['lat']?>,<?=$pic_info[$poi_images[0]]['lng']?>,'<?=$pic_info[$poi_images[0]]['text']?>');">
          <div class="hvrbox <?=$pic_info[$poi_images[0]]['dnone']?>">
            <img src="<?=$pic_info[$poi_images[0]]['img']?>" style="height: 250px; width:600px; object-fit:cover;">
            <div class="hvrbox-layer_top hvrbox-layer_scale">
              <div class="hvrbox-text" style="font-size:1em;"><?=$pic_info[$poi_images[0]]['text']?></div>
            </div>
          </div></a>


          <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[1]]['lat']?>,<?=$pic_info[$poi_images[1]]['lng']?>,'<?=$pic_info[$poi_images[1]]['text']?>');">
          <div class="hvrbox <?=$pic_info[$poi_images[1]]['dnone']?>">
            <img src="<?=$pic_info[$poi_images[1]]['img']?>" style="height: 250px; width:600px; object-fit:cover;">
            <div class="hvrbox-layer_top hvrbox-layer_scale">
              <div class="hvrbox-text" style="font-size:1em;"><?=$pic_info[$poi_images[1]]['text']?></div>
            </div>
          </div></a>


          <a href="#" onclick="markerAnimate(<?=$pic_info[$poi_images[2]]['lat']?>,<?=$pic_info[$poi_images[2]]['lng']?>,'<?=$pic_info[$poi_images[2]]['text']?>');">
          <div class="hvrbox <?=$pic_info[$poi_images[2]]['dnone']?>">
            <img src="<?=$pic_info[$poi_images[2]]['img']?>" style="height: 250px; width:600px; object-fit:cover;">
            <div class="hvrbox-layer_top hvrbox-layer_scale">
              <div class="hvrbox-text" style="font-size:1em;"><?=$pic_info[$poi_images[2]]['text']?></div>
            </div>
          </div></a>
              

    
						</div>
						
				
						</div>
        </div>
      </div>
    </div>
<!-- section right small-->





    </div>
  </div>

  <?php
  if( $total>3){
    ?>

    <div class="row" style="height:50px; size:100px; ">
      <div class="col-md-12" align="right" >

        <a href="#" onclick="window.location='<?=$next?>';">หน้าถัดไป</a> &nbsp;&nbsp; &nbsp;
      </div>
    </div>
  <?php } ?>



  <?php require_once('./footer.php'); ?>

  <script src="assets/js/rAF.js"></script>
  <script src="assets/js/demo-2.js"></script>
</body>
</html>