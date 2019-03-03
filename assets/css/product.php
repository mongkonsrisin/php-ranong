<link rel="shortcut icon" href="assets/img/all/icon.ico">
<?php require_once('./navbar.php'); ?>
<?php require_once('./db_config.php'); ?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
       
    
    <link rel="stylesheet" href="./assets/fonts/font.css">
   <link rel="stylesheet" href="./assets/css/navbar.css"> 
    <link rel="stylesheet" href="assets/css/otop_global.css">
    <link rel="stylesheet" href="assets/css/otop_responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    
    
    <!-- script code -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    
    <!-- slick -->
    <link rel="stylesheet" href="assets/source_slickslide/slick-theme.css" media="screen">
    <link rel="stylesheet" href="assets/source_slickslide/slick.css" media="screen">


    
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
        
    
    
    <title>รักนะระนอง</title>
    
    <link href="assets/css/main.550dcf66.css" rel="stylesheet"> 
    
    
    <style>
      
      body {
        font-family: 'DBHelvethaicaXMedCondv3_2';
        background-color: #e9e3e3;
      }
      h4{
        font-family: 'DBHelvethaicaXMedCondv3_2';
      }
      .container-fluid {
        position: relative;
        font-family: 'Kanit', sans-serif ;
      }
      
      .container-fluid .content {
        position: absolute;
        left:20px;
        bottom: 0;
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
  .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #E0E0E0;
    color: #000000;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    margin-left: -60px;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}


</style>

</head>

<body> <!-- Add your content of header -->
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
<section class="section">
  <img src="assets/img/all/otop.gif" class="img-responsive otop" style="z-index:999;width:170px;position:absolute;left:15%;">
</section>
<div class="parallax">
  <div class="caption">
    <span class="border" style="font-size:25px;color: #f7f7f7;"><strong>

    </strong></span>
  </div>
</div>
<div style="padding:40px; margin:0px;" >
</div>
<div class="section-container" action="?action=product">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-8 col-md-offset-2" align="center">
      
        <h1 class="text-center"></h1>


        <?php
          $q = $_GET['q'];
          $sql = "SELECT * FROM tbl_poi WHERE poi_cat=4 AND (poi_name LIKE '%$q%' OR poi_id LIKE '%$q%') ";
          $result = mysqli_query($con,$sql);
          $products = mysqli_fetch_all($result,MYSQLI_ASSOC);

        ?>

        <div class="container-fluid d-none d-md-block">    
       <form action="product.php" method="get" class="form-inline" style="float:right">
         <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">
         <button class="btn btn-primary"> <i class="fa fa-search"></i></button>
       </form>
   </div>


<div class="container-fluid d-block d-md-none"> 
<br><br>
   <form method="get" action="product.php">
  <div class="input-group">
    <input type="text" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">
    <div class="input-group-btn">
      <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
    </div>
  </div>
</form>
</div>

   <?php
      $i = 1;
      foreach($products as $product) {
   ?>

<?php }?>



          <?php
                // // random
                // $order = " order by ";
                // $t = intval(date('s'))%10;
                // if($t < 3) $order .= "poi_id asc "; 
                // else if($t < 5) $order .= "poi_name ";
                // else if($t < 7) $order .= "poi_lat ";
                // else $order .= "poi_id desc ";
                // // end random

              
              $sql = "SELECT * FROM tbl_poi WHERE  poi_show = 1 and  poi_cat=4 $order "  ."ORDER BY RAND()";


              if(isset($_GET['q'])){
                $sql = "SELECT * FROM tbl_poi WHERE poi_cat=4 AND (poi_name LIKE '%$q%' OR poi_id LIKE '%$q%') ";
              }


              $result = mysqli_query($con,$sql);
              $i =1;

              while ($row = mysqli_fetch_assoc($result)) {
                  $photo_url= "assets/img/otop/".$row['poi_id'].".png";
                  if( file_exists($photo_url) ) {  ?>
          <div class="col-12 col-md-6 col-lg-4"align="center">
            <div style="padding:10px; margin:0px;" >
              <img src="<?php echo $photo_url ?>"  class="img-responsive reveal-content"   style="border-radius: 40px 40px; ">
              <div class="content " align="center">
                <h4 align="center" ><font size="5px" color="#2a3668"><?php echo $row['poi_name'] ?></font></h4>
                <p align="center" > 
                  <a href="https://facebook.com/">
                  <i class="fa fa-facebook social-round-icon white-round-icon fa-icon" aria-hidden="true" style="color:#F4511E;"></i> </a>
                  <i class="fa fa-phone social-round-icon white-round-icon fa-icon tooltip" aria-hidden="true" style="color:#F4511E;"><span class="tooltiptext"><?php echo $row['poi_mobile']  ?></span></i>
                  <a href="https://www.google.co.th/maps/search/เลขที่+5%2F2++หมู่ที่+4++ตำบลม่วงกลวง++อำเภอกกะเปอร์++จังหวัดระนอง++85120/@9.6051333,98.539108,17z/data=!3m1!4b1"><i class="fa fa-map social-round-icon white-round-icon fa-icon" aria-hidden="true" style="color:#F4511E;"></i></a>
                  <a href="product_description.php?id=<?php echo $row['poi_id'] ?>"><i class="fa fa-shopping-basket social-round-icon white-round-icon fa-icon" aria-hidden="true" style="color:#F4511E;"></i></a>
                  <?php 
                      
                      if($row['poi_hasactivity'] == 1)
                      
                  
                  { ?>        
                    <a href="community_activities.php">
                    <i class="fa fa-users social-round-icon white-round-icon fa-icon" aria-hidden="true" style="color:#F4511E;"></i>
                    
                  </a>
                  <?php $i++; }?> 


                </p>
              </div>
            </div>
          </div>
            <?php } } ?>

          
        </div>
      </div>
    </div>
  </div>
</div>

                  



</div>
</div>

<?php require_once('./footer.php'); ?>
