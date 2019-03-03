<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
//Check if user is hotel
if($_SESSION['cat'] != 1) {
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
  window.location.href = 'delete.php?id=' + id + '&tb=bed&back=allbed&poiid='+poiid;
})
</script>

<?php $q = $_GET['q']; ?>
<div class="container">
  <h3 class="text-center">รายการห้องพัก</h3>

<br>
<form method="get">
<div class="row">
<div class="col-12 col-sm-9">
<input type="text" style="width:200px; display:inline;" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">

<button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> ค้นหา</button>
&nbsp;&nbsp;
</div>
  <div class="col-12 col-sm-3" >
    <a href="newbed.php" style="float:right;" role="button" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มห้องพัก</a>
  </div>
  <div style="height:5px;">&nbsp;</div>

</div> 
</from>

  <table class="table table-hover table-responsive-sm">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">รูปสถานที่</th>
        <th scope="col">ชื่อที่พัก</th>
        <th scope="col">จำนวนคนเข้าพักสูงสุด</th>
        <th scope="col">ราคา</th>
        <th scope="col" style="text-align:center;">ห้อง</th>
        <th scope="col" width="100">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM tbl_room rm LEFT JOIN tbl_poi poi ON (rm.rm_poiid = poi.poi_id) WHERE rm.rm_poiid=".$_SESSION['id'];
        if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_room rm LEFT JOIN tbl_poi poi ON (rm.rm_poiid = poi.poi_id) WHERE (rm_price LIKE '%$q%' OR rm_size LIKE '%$q%' OR poi_name LIKE '%$q%') AND rm.rm_poiid=".$_SESSION['id'];
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
          if ($row['rm_size'] == 's'){
            $roompic = "../assets/img/all/bedsm.png";
          }
          else if ($row['rm_size'] == 'm'){
            $roompic = "../assets/img/all/bedmd.png";
          }
          else if ($row['rm_size'] == 'l'){
            $roompic = "../assets/img/all/bedlg.png";
          }
          else $roompic = "";
          
       ?>
      <tr>
        <th scope="row"><?php echo $i; ?></th>
        <td width="150">
          <a href="../assets/img/poi/s/<?php echo $row['poi_id'] ?>.png?cache=none" data-lightbox="<?php echo $row['poi_id'] ?>" data-title="<?php echo $row['poi_name'] ?>">
            <img src="../assets/img/poi/s/<?php echo $row['poi_id'] ?>.png?cache=none" class="img-fluid">
          </a>
        </td>
        <td><?php echo $row['poi_name'] ?></td>
        <td><?php echo $row['rm_maxpeople'] ?></td>
        <td><?php echo number_format($row['rm_price']) ?>&nbsp;฿</td>
        <td align="center"><?php echo strtoupper($row['rm_size']) ?><br><img src="<?php echo $roompic ?>" height="80"> </td>
        <td width="100">
          <a href="editbed.php?id=<?php echo $row['rm_id'] ?>" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
          <br>
          <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" data-poiid="<?php echo $row['rm_poiid'] ?>" data-id="<?php echo $row['rm_id'] ?>" data-title="<?php echo $row['poi_name'] ?>"><i class="fas fa-trash"></i> ลบ</a>
        </td>

      </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
</div>
<?php require("template/footer.php") ?>
