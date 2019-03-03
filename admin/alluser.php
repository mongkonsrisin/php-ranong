<?php require("template/header.php") ?>
<?php
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}


if( $_SESSION['role'] != 'admin') {
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
  adminid = button.data('adminid');
  var modal = $(this);
  modal.find('.modal-topictitle').text(text);
});

$("#del").click(function (e) {
  window.location.href = 'delete.php?id=' + id + '&tb=admin&back=alluser&adminid='+adminid;
})
</script>


<?php
$q = $_GET['q'];
// $sql = "SELECT * FROM tbl_admin WHERE admin_user LIKE '%$q%' OR admin_name LIKE '%$q%' OR admin_lname LIKE '%$q%' ";
// $result = mysqli_query($con,$sql);
// $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<div class="container">

  <h3 class="text-center">ผู้ดูแลระบบ</h3>

<br>
<form method="get">
<div class="row">
<div class="col-12 col-sm-9">
<input type="text" style="width:200px; display:inline;" class="form-control" name="q" placeholder="ค้นหา..." value="<?php echo $q ?>">

<button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> ค้นหา</button>
&nbsp;&nbsp;
</div>

  <div class="col-12 col-sm-3" >
    <a href="newuser.php" style="float:right;" role="button" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มผู้ดูแล</a>
  </div> 

<div style="height:5px;">&nbsp;</div>

  </div> 
</from>


  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col" width="80">รูป</th>
        <th scope="col" width="80">Username</th>
        <th scope="col" width="100">คำนำหน้า</th>
        <th scope="col" width="100">ชื่อ</th>
        <th scope="col" width="100">นามสกุล</th>
        <th scope="col" width="100">เมนู</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM tbl_admin WHERE admin_role != 'admin'";
        if(isset($_GET['q'])) {
          $sql = "SELECT * FROM tbl_admin WHERE admin_role != 'admin' AND (admin_user LIKE '%$q%' OR admin_name LIKE '%$q%' OR admin_lname LIKE '%$q%') ";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
       ?>
      <tr>
        <th scope="row"><?php echo $i; ?></th>
        <td width="500">
        <a href="../assets/img/user/<?php echo $row['admin_id'] ?>.png?cache=none" data-lightbox="<?php echo $row['admin_id'] ?>" data-title="<?php echo $row['admin_name'] ?>">
            <img src="../assets/img/user/<?php echo $row['admin_id'] ?>.png?cache=none" class="img-fluid">
        </a>
        </td>
        <td width="500">
        <?php echo $row['admin_user'] ?>  
        </td>

        <td width="800">
        <?php 
        if ($row['admin_title'] == 0){
          echo "นาย" ;
        }else if ($row['admin_title'] == 1){
          echo "นาง" ;
        }else {
          echo "นางสาว" ;
        }
        ?>     
        </td>

        <td width="800">
        <?php echo $row['admin_name'] ?>     
        </td>

        <td width="800">
        <?php echo $row['admin_lname'] ?>          
        </td>
    
        
        <td width="200">
        
            <a href="edituser.php?id=<?php echo $row['admin_id'] ?>" class="text-primary"><i class="fas fa-edit"></i> แก้ไข</a>
            <br>
            <a href="#" class="text-danger" data-toggle="modal" data-target="#modal" data-adminid="<?php echo $row['admin_id'] ?>" data-id="<?php echo $row['admin_id'] ?>" data-title="<?php echo $row['admin_user'] ?>"><i class="fas fa-trash"></i> ลบ</a>

        </td>
      </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
</div>
<?php require("template/footer.php") ?>
