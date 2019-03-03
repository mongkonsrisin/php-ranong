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

  <?php if( $_SESSION['role'] == 'admin') {?>
    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-user"></i> ผู้ดูแล</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_admin WHERE admin_role !='admin'";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="alluser.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printuser.php" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>
<?php } ?>





<div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-map-marker"></i> หมุดสถานที่</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_pin";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allpin.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printpin.php?" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>

<div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-image"></i> ภาพหน้าหลัก</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_slider";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allslider.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printslider.php?" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fab fa-accessible-icon"></i> กำหนดกิจกรรม</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_activity";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allactivity.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printactivity.php" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>


	<div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-blind"></i> ประเภทกิจกรรม</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_activity_icon";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allactivitycat.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printactivitycat.php?" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>

    </div>
<hr>

<div class="row">

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-bus"></i> สถานที่ท่องเที่ยว</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_poi WHERE poi_cat=2";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allpoi.php?cat=2" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printpoi.php?cat=2" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>


    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-utensils"></i> ร้านอาหาร</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_poi WHERE poi_cat=3";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allpoi.php?cat=3" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printpoi.php?cat=3" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>


    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="far fa-building"></i> ที่พัก</h5>
          <?php
          $sql = "SELECT COUNT(*) c FROM tbl_poi WHERE poi_cat=1";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allpoi.php?cat=1" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printpoi.php?cat=1" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-shopping-bag"></i> ร้านสินค้าชุมชน</h5>
          <?php
          $sql = "SELECT COUNT(*) c FROM tbl_poi WHERE poi_cat=4";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allpoi.php?cat=4" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printpoi.php?cat=4" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-briefcase"></i> โปรแกรมท่องเที่ยว</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_package";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allprogram.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printprogram.php" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fab fa-codiepie"></i> อาหาร</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_food";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allfood.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printfood.php" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-bed"></i> ห้องพัก</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_room";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allbed.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printbed.php?" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>

        </div>
      </div>
    </div>
    
    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-shopping-cart"></i> สินค้าชุมชน</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_product";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allproduct.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printproduct.php" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-white border-primary mb-3">
        <div class="card-body">
          <h5 class="card-title text-primary"><i class="fas fa-child"></i> ผู้ประกอบการ</h5>
          <?php
            $sql = "SELECT COUNT(*) c FROM tbl_poi WHERE poi_cat=4";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          ?>
          <p class="card-text text-dark"><?php echo $row['c']; ?> รายการ</p>
          <a href="allseller.php" class="btn btn-primary full-width-on-mobile mb-2"><i class="fas fa-eye"></i> ดูข้อมูล</a>
          <a href="printseller.php" target="_blank" class="btn btn-success full-width-on-mobile mb-2"><i class="fas fa-file-pdf"></i> พิมพ์</a>
        </div>
      </div>
    </div>

  </div>
</div>
<?php require("template/footer.php") ?>
