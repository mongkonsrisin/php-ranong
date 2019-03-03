<?php require("template/header.php") ?> 
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
if(isset($_SESSION['route']))
unset($_SESSION['route']);
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
  pkid = button.data('pkid');
  var modal = $(this);
  modal.find('.modal-topictitle').text(text);
});

$("#del").click(function (e) {
  window.location.href = 'delete.php?id=' + id + '&tb=package&back=allprogram&pkid='+pkid;
})
</script>
<?php $q = $_GET['q']; ?>
<div class="container">
  <h3 class="text-center">รายการโปรแกรมท่องเที่ยว</h3>
  <br>
<form method="get">
<div class="row">
<div class="col-12 col-sm-9">
<input type="text" style="width:200px; display:inline;" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">

<button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> ค้นหา</button>
&nbsp;&nbsp;
</div>
  <div class="col-12 col-sm-3" >
    <a href="newprogram.php?action=new" style="float:right;" role="button" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มโปรแกรม</a>
  </div>
  <div style="height:5px;">&nbsp;</div>

</div> 
</from>

  <table class="table table-hover table-responsive-sm">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">ชื่อโปรแกรม</th>
        <th scope="col">งบประมาณ</th>
        <th scope="col">เส้นทาง</th>
        <th scope="col">รูปโปรแกรม</th>
        <th scope="col" width="100">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php
        
        $sql = "SELECT * FROM tbl_package";
        if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_package WHERE pk_title LIKE '%$q%' OR pk_budget LIKE '%$q%' ";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
       ?>
      <tr>
        <th scope="row"><?php echo $i; ?></th>
        <td><?php echo $row['pk_title'] ?></td>
        <td><?php echo $row['pk_budget'] ?>&nbsp;฿</td>
        <td><?php
          $pois = array();
          $actdetail = array();  
          $pois = explode("|",$row['pk_route']);
          $j = 1;
          foreach ($pois as $poi) {
            $sql2 = 'SELECT * FROM tbl_poi p LEFT JOIN tbl_activity a ON (p.poi_id = a.act_poiid) WHERE poi_id=? ';
            
            $stmt2 = $con->prepare($sql2);
            $stmt2->bind_param("i",$poi);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $row2 = $result2->fetch_assoc();
            echo '<i class="fas fa-map-pin"></i>&nbsp;';
            echo $j.'.'.$row2['poi_name'].'&nbsp;';
            if(!empty($row2['act_icon'])) {
              $actpic = '<img src="../assets/img/package/icon/'.$row2['act_icon'].'.png" style="width:30px;">';
              echo $actpic;
            }
            echo '<br>';
            $j++;
          }
          ?></td>
          
          <td><a href="../assets/img/package/<?php echo $row['pk_id'] ?>/preview<?=$row['pk_id']?>.png?cache=none" data-lightbox="<?php echo $row['pk_id'] ?>" data-title="<?php echo $row['pk_title'] ?>">
          <img src="../assets/img/package/<?php echo $row['pk_id'] ?>/preview<?=$row['pk_id']?>.png?cache=none" data-toggle="tooltip" data-placement="top" class="img-fluid" width="180px">
          </a></td>
        <td>
          <a href="editprogram.php?id=<?php echo $row['pk_id'] ?>" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
          <br>
          <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" data-pkid="<?php echo $row['pk_id'] ?>" data-id="<?php echo $row['pk_id'] ?>" data-title="<?php echo $row['pk_title'] ?>"><i class="fas fa-trash"></i> ลบ</a>
        </td>

      </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
</div>
<?php require("template/footer.php") ?>
