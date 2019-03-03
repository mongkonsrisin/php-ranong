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
<?php $q = $_GET['q']; ?>
<div class="container">
<?php
	if($_GET['cat']==1) $title='รายการที่พัก';
	else if($_GET['cat']==2) $title='รายการสถานที่ท่องเที่ยว';
	else if($_GET['cat']==3) $title='รายการร้านอาหาร';
	else if($_GET['cat']==4) $title='รายการแหล่งจำหน่ายสินค้าชุมชน';
	else $title='รายการสถานที่ต่าง ๆ';

?>
  <h3 class="text-center"><?=$title?></h3>
  <br>
<form method="get">
<div class="row">
<div class="col-12 col-sm-9">
<input type="text" style="width:200px; display:inline;" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">

<button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> ค้นหา</button>
&nbsp;&nbsp;
</div>
  <div class="col-12 col-sm-3">
    <a href="newpoi.php?cat=<?=$_GET['cat']?>" style="float:right;" role="button" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มสถานที่</a>
  </div>
  <div style="height:5px;">&nbsp;</div>
  </div> 
</from>

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
		  <th scope="col" width="150">สถานะ</th>
        <th scope="col" width="100">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php


      if(isset($_GET['cat'])) {
        $sql = "SELECT * FROM tbl_poi poi LEFT JOIN tbl_category c ON poi.poi_cat=c.cat_id LEFT JOIN tbl_pin pin ON poi.poi_pin=pin.pin_id WHERE poi_cat=".$_GET['cat'];
        if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_poi poi LEFT JOIN tbl_category c ON poi.poi_cat=c.cat_id LEFT JOIN tbl_pin pin ON poi.poi_pin=pin.pin_id WHERE poi_cat=".$_GET['cat']." AND (poi_name LIKE '%$q%' OR cat_name LIKE '%$q%') ";
        }
      } else {
        $sql = "SELECT * FROM tbl_poi poi LEFT JOIN tbl_category c ON poi.poi_cat=c.cat_id LEFT JOIN tbl_pin pin ON poi.poi_pin=pin.pin_id";
        if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_poi poi LEFT JOIN tbl_category c ON poi.poi_cat=c.cat_id LEFT JOIN tbl_pin pin ON poi.poi_pin=pin.pin_id WHERE poi_name LIKE '%$q%' OR cat_name LIKE '%$q%' ";
        }
      }
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
		    <td>

		 <?php if($row['poi_show'] == 0 ) { ?>
		 		 <i class="fa fa-circle text-danger"></i> ซ่อน
		<?php } else if($row['poi_show'] == 1 ) { ?>
		 <i class="fa fa-circle text-success"></i> แสดง
		 <?php } ?>
		 
		 </td>
        <td width="150">
			<?php 
			
			switch($row['poi_show']) {
				case 0: $status=1;break;
				case 1: $status=0;break;
				default: break;

			}	

		?>
		<a href="#" class="text-warning" onclick="setVisibility('poi',<?php echo $row['poi_id']  ?>,<?php echo $status ?>);"><i class="fas fa-edit"></i> แสดง/ซ่อน</a>
		<br>
          <a href="gallerypoi.php?id=<?php echo $row['poi_id'] ?>" class="text-success"><i class="fas fa-image"></i> แกลอรี่</a>
		  <br>
          <a href="editpoi.php?id=<?php echo $row['poi_id'] ?>" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
          <br>
          <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" data-poiid="<?php echo $row['poi_id'] ?>" data-id="<?php echo $row['poi_id'] ?>" data-title="<?php echo $row['poi_name'] ?>"><i class="fas fa-trash"></i> ลบ</a>
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
	  //window.location.href='allpoi.php?cat=<?=$_GET["cat"];?>#target'+id;
	  
      }
    });
	}
</script>
<?php require("template/footer.php") ?>
