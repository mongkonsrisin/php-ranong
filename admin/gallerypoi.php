<?php require("template/header.php") ?>
<div class="container">
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
var id,text,file;
$('#modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  text = button.data('title');
  id = button.data('id');
  file = button.data('file');
  var modal = $(this);
  modal.find('.modal-topictitle').text(text);
});

$("#del").click(function (e) {
  window.location.href = 'deletegallery.php?id=' + id + '&f=' + file;
})
</script>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_poi WHERE poi_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$id = $_GET['id'];
 $directory = "../assets/img/photo/$id/";
 $allpics = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
 ?>

 <h3 class="text-center">แกลอรี่ภาพ</h3>
<h5 class="text-center mb-3"><?php echo $row['poi_name']?></h5>
<div class="text-right mb-3">
<a href="newgallery.php?id=<?php echo $row['poi_id']?>" class="btn btn-success" role="button"><i class="fas fa-plus"></i> เพิ่มรูปภาพ</a>
</div>
 <?php
 

 if ($allpics != false) {
 	 $filecount = count($allpics);
   echo '<div class="row">';
 	 for($i=0;$i<$filecount;$i++) { 
    $filename = str_replace($directory,"",$allpics[$i]);

      ?>
       <div class="col-lg-3 col-md-4 col-sm-6">
         <div class="card mb-3 p-1">
           <img src="<?php echo $allpics[$i]; ?>" class="img-fluid mb-2">
           <h5 class="card-title text-center">ภาพที่ <?php echo $i+1; ?></h5>
           <a href="deletegallery.php?f=<?=$filename?>" class="text-danger text-center" data-toggle="modal" data-target="#modal" data-id="<?=$id?>" data-file="<?=$filename?>" data-title="<?php echo 'ภาพที่ '. ($i+1); ?>"><i class="fas fa-trash"></i> ลบรูปภาพ</a>
         </div>
       </div>
 	<?php }
  echo '</div>';
 } else {
 	echo '<div class="alert alert-danger" role="alert">
   ไม่พบรูปภาพ
   </div>';
 }
  ?>
</div>
 <?php require("template/footer.php") ?>
