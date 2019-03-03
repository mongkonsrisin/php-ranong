<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
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
  window.location.href = 'delete.php?id=' + id + '&tb=seller&back=allseller&poiid='+poiid;
})
</script>

<?php $q = $_GET['q']; ?>
<div class="container">
  <h3 class="text-center">ผู้ประกอบการสินค้าชุมชน</h3>
  
  <br>
<form method="get">
<div class="row">
<div class="col-12">
<input type="text" style="width:200px; display:inline;" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">

<button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> ค้นหา</button>
&nbsp;&nbsp;
</div>
  <div style="height:5px;">&nbsp;</div>

</div> 
</from>


  <table class="table table-hover table-responsive-sm">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col" width="220">รูปผู้ประกอบการ</th>
        <th scope="col" width="100">ชื่อร้านค้า</th>
        <th scope="col" width="100">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM tbl_poi WHERE poi_cat=4";
        if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_poi WHERE poi_cat=4 AND (poi_name LIKE '%$q%') ";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
       ?>
      <tr>
        <th scope="row"><?php echo $i; ?></th>
        <td width="200">
          <a href="../assets/img/otop/<?php echo $row['poi_id'] ?>.png?cache=none" data-lightbox="<?php echo $row['pro_id'] ?>" data-title="<?php echo $row['pro_name'] ?>">
            <img src="../assets/img/otop/<?php echo $row['poi_id'] ?>.png?cache=none" class="img-fluid">
          </a>
        </td>
        
        <td><?php echo $row['poi_name'] ?></td>
        
        <td width="100">
          <a href="editseller.php?id=<?php echo $row['poi_id'] ?>" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
          <br>
          <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" data-poiid="<?php echo $row['poi_id'] ?>" data-id="<?php echo $row['poi_id'] ?>" data-title="<?php echo $row['poi_name'] ?>"><i class="fas fa-trash"></i> ลบ</a>
        </td>

      </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
</div>
<?php require("template/footer.php") ?>
