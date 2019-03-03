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
  window.location.href = 'delete.php?id=' + id + '&tb=slider&back=allslider&poiid='+poiid;
})
</script>

<?php
$q = $_GET['q'];
?>

<div class="container">

  <h3 class="text-center">รายการภาพหน้าหลัก</h3>

<br>
<form method="get">
<div class="row">
<div class="col-12 col-sm-9">
<input type="text" style="width:200px; display:inline;" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">

<button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> ค้นหา</button>
&nbsp;&nbsp;
</div>
  <div class="col-12 col-sm-3">
    <a href="newslider.php" role="button" style="float:right;" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มรูปภาพ</a>
  </div>
  <div style="height:5px;">&nbsp;</div>
  </div> 
</from>

  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col" width="150">รูปภาพ</th>
        <th scope="col">ชื่อสถานที่</th>
             <th scope="col">สถานะ</th>

        <th scope="col" width="150">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php


         $sql = "SELECT * FROM tbl_slider s LEFT JOIN tbl_poi p ON s.sld_poiid = p.poi_id";
         if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_slider s LEFT JOIN tbl_poi p ON s.sld_poiid = p.poi_id WHERE sld_poiid LIKE '%$q%' OR sld_name LIKE '%$q%' ";
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

          <a href="../assets/img/slide/<?php echo $row['sld_id'] ?>.png?cache=none" data-lightbox="<?php echo $row['sld_id'] ?>" data-title="<?php echo $row['sld_id'] ?>">
            <img src="../assets/img/slide/<?php echo $row['sld_id'] ?>.png?cache=none"  width="150">
          </a>

        </td>
        <td><?php echo $row['poi_name'] ?></td>
         <td>

		 <?php if($row['sld_show'] == 0 ) { ?>
		 		 <i class="fa fa-circle text-danger"></i> ซ่อน
		<?php } else if($row['sld_show'] == 1 ) { ?>
		 <i class="fa fa-circle text-success"></i> แสดง
		 <?php } ?>
		 
		 </td>

  
        <td width="150">
		<?php 
			
			switch($row['sld_show']) {
				case 0: $status=1;break;
				case 1: $status=0;break;
				default: break;

			}	

		?>
		<a href="#" class="text-warning" onclick="setVisibility('slider',<?php echo $row['sld_id']  ?>,<?php echo $status ?>);"><i class="fas fa-edit"></i> แสดง/ซ่อน</a>
          <br>
          <a href="editslider.php?id=<?php echo $row['sld_id'] ?>" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
          <br>
          <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" data-poiid="<?php echo $row['sld_poiid'] ?>" data-id="<?php echo $row['sld_id'] ?>" data-title="<?php echo $row['sld_name'] ?>"><i class="fas fa-trash"></i> ลบ</a>
        </td>
      </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
</div>
<script>
function setVisibility(table,id,visible) {
    $.ajax({
      url: "ajax/visible.php",
      data: ({ table:table,id:id,visible:visible }),
      success: function() {
        location.reload();
      }
    });
	}
</script>
<?php require("template/footer.php") ?>
