<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
?>
<?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM tbl_product WHERE pro_id=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("i",$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>
<div class="container">
  <h3 class="text-center">รายละเอียด</h3>
  <hr>
  <form action="" method="post">
    <div class="card bg-light border-dark mb-3">
      <div class="card-body">
        <div class="form-group">
          <label for="pro_name"><strong>ชื่อสินค้า</strong></label>
          <input type="text" class="form-control" value="<?php echo $row['pro_name']?>" id="pro_name" name="pro_name" autofocus>
          <small class="form-text text-muted">Title must less than 200 characters.</small>
        </div>
        <div class="form-group">
          <label for="pro_description"><strong>คำอธิบาย</strong></label>
          <textarea class="form-control" rows="8" id="pro_description" name="pro_description" style="resize:none"><?php echo $row['pro_description']?></textarea>
          <small class="form-text text-muted">Content must less than 1024 characters.</small>
        </div>
        <div class="form-group">
          <label for="pro_price"><strong>ราคา</strong></label>
          <input type="number" class="form-control" value="<?php echo $row['pro_price']?>" min="0" id="pro_price" name="pro_price" autofocus>
          <small class="form-text text-muted">Title must less than 200 characters.</small>
        </div>
        <div class="form-group">
          <label for="pro_poiid">สถานที่</label>
          <select class="form-control" id="pro_poiid" name="pro_poiid">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
          <small class="form-text text-muted">เลือกสถานที่ของสินค้า</small>
      </div>
      <div class="text-right mt-5">
        <button class="btn btn-success full-width-on-mobile" type="submit"><i class="fas fa-save"></i> บันทึก</button>
      </div>
    </div>
  </form>
</div>
<?php require("template/footer.php") ?>
