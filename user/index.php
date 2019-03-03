<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<div class="container">
  <h3 class="mb-3"><i class="fas fa-user"></i> ยินดีต้อนรับ <?php echo $_SESSION['user']; ?></h3>
  
<div class="row">

<div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary">สถานที่</h5>
          <a href="allpoi.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>

        </div>
      </div>
    </div>

    <?php if($_SESSION['cat']==3) { ?>


    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fab fa-codiepie"></i> อาหาร</h5>
          <a href="allfood.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if($_SESSION['cat']==1) { ?>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-bed"></i> ห้องพัก</h5>
          <a href="allbed.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>

        </div>
      </div>
    </div>
    <?php } ?>
    <?php if($_SESSION['cat']==4) { ?>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-shopping-cart"></i> สินค้าชุมชน</h5>
          <a href="allproduct.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
        </div>
      </div>
    </div>
    <?php } ?>


  </div>
</div>
<?php require("template/footer.php") ?>
