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
  window.location.href = 'delete.php?id=' + id + '&tb=poi&back=allpoi&cat=<?=$_GET['cat']?>&poiid='+poiid;
})
</script>
<div class="container">

  <h3 class="text-center">สถานที่</h3>
  <br>


  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col" width="150">รูปหลัก</th>
        <th scope="col">ชื่อสถานที่</th>
        <th scope="col">ประเภท</th>
        <th scope="col">ประเภทสถานที่</th>
        <th scope="col">ภาพหมุด</th>
        <th scope="col">พิกัด</th>
        <th scope="col" width="100">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php


$sql = "SELECT * FROM tbl_poi poi LEFT JOIN tbl_category c ON poi.poi_cat=c.cat_id LEFT JOIN tbl_pin pin ON poi.poi_pin=pin.pin_id WHERE poi_id=".$_SESSION['id'];

        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
       ?>
      <tr id="target<?php echo $row['poi_id'] ?>">
        <th scope="row"><?php echo $i; ?></th>
        <td width="150">

		<?php 

		if(file_exists('../assets/img/poi/s/'.$row['poi_id'].'.png')) {
		
		?>


          <a href="../assets/img/poi/s/<?php echo $row['poi_id'] ?>.png?cache=none" data-lightbox="<?php echo $row['poi_id'] ?>" data-title="<?php echo $row['poi_name'] ?>">
            <img src="../assets/img/poi/s/<?php echo $row['poi_id'] ?>.png?cache=none"  width="150">
          </a>

		  <?php } else {?>
		              <img src="assets/img/no_image.jpg"  width="150">


		  <?php } ?>

        </td>
        <td><?php echo $row['poi_name'] ?></td>
        <td><?php echo $row['cat_name'] ?></td>
          <?php
          if($row['poi_type']==0) $title='-';
          else if($row['poi_type']==1) $title='เชิงนิเวศ';
          else if($row['poi_type']==2) $title='เชิงสุขภาพ';
          ?>
          <td><?php echo $title ?></td>
        <td><img src="../assets/img/pin/pin<?php echo $row['poi_pin'] ?>.png" data-toggle="tooltip" data-placement="top" title="<?php echo $row['pin_name'] ?>" class="img-fluid"></td>
        <td>
          <?php
            if(empty($row['poi_lat']) || empty($row['poi_lng'])) {
              echo '<span class="text-danger">ไม่มี</span>';
            } else {
              echo $row['poi_lat'].'<br>'.$row['poi_lng'];
            }
          ?></td>
		  
        <td width="150">
		
          <a href="gallerypoi.php" class="text-success"><i class="fas fa-image"></i> แกลอรี่</a>
		  <br>
          <a href="editpoi.php" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
        </td>
      </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
</div>

<?php require("template/footer.php") ?>
