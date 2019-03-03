<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
//Check if user is food
if($_SESSION['cat'] != 3) {
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
  exit();
}
?>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal">ยืนยัน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <strong><span class="modal-topictitle"></span></strong> จะถูกลบถาวร ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-danger" id="del"><i class="fas fa-trash"></i> ลบ</button>
      </div>
    </div>
  </div>
</div>

<script>
var id,text;
$('#modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  text = button.data('title');
  id = button.data('id');
  poiid = button.data('poiid');
  var modal = $(this);
  modal.find('.modal-topictitle').text(text);
});

$("#del").click(function (e) {
  window.location.href = 'delete.php?id=' + id + '&tb=food&back=allfood&poiid='+poiid;
})
</script>

<?php $q = $_GET['q']; ?>
<div class="container">
  <h3 class="text-center">รายการอาหาร</h3>

<br>
<form method="get">
<div class="row">
<div class="col-12 col-sm-9">
<input type="text" style="width:200px; display:inline;" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">

<button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> ค้นหา</button>
&nbsp;&nbsp;
</div>
  <div class="col-12 col-sm-3" >
    <a href="newfood.php" role="button" style="float:right;" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มอาหาร</a>
  </div>
  <div style="height:5px;">&nbsp;</div>

</div> 
</form>

  <table class="table table-hover table-responsive-sm">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col" width="150">รูปอาหาร</th>
        <th scope="col">ชื่ออาหาร</th>
        <th scope="col">ชื่อร้านค้า</th>
        <th scope="col">ราคา</th>
        <th scope="col" width="100">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM tbl_food f LEFT JOIN tbl_poi p ON (f.fd_poiid = p.poi_id) WHERE f.fd_poiid=".$_SESSION['id'];
        if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_food f LEFT JOIN tbl_poi p ON (f.fd_poiid = p.poi_id) WHERE (fd_name LIKE '%$q%' OR fd_price LIKE '%$q%' OR poi_name LIKE '%$q%') AND f.fd_poiid=".$_SESSION['id'];
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
       ?>
      <tr>
        <th scope="row"><?php echo $i; ?></th>
        <td width="150">

          <a href="../assets/img/food/<?php echo $row['fd_poiid'] ?>/<?php echo $row['fd_id']?>.png" data-lightbox="<?php echo $row['fd_id'] ?>" data-title="<?php echo $row['fd_name'] ?>">
            <img src="../assets/img/food/<?php echo $row['fd_poiid'] ?>/<?php echo $row['fd_id']?>.png" class="img-fluid">
          </a>
        </td>
        <td><?php echo $row['fd_name'] ?></td>
        <td><?php echo $row['poi_name'] ?></td>
        <td><?php echo number_format($row['fd_price']) ?>&nbsp;฿</td>
        <td width="100">
          <a href="editfood.php?id=<?php echo $row['fd_id'] ?>" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
          <br>
          <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" data-poiid="<?php echo $row['fd_poiid'] ?>" data-id="<?php echo $row['fd_id'] ?>" data-title="<?php echo $row['fd_name'] ?>"><i class="fas fa-trash"></i> ลบ</a>
        </td>

      </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
</div>
<?php require("template/footer.php") ?>
