<?php
//require ("../config/session.php");
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
require ("../config/dbconfig.php");
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_subdistrict WHERE sub_amid=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
	$data[] = $row;
}
echo json_encode($data);
$con->close();

?>
