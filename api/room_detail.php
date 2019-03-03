<?php
require('../db_config.php');
$response = array();
$sql = "SELECT * FROM tbl_room WHERE rm_poiid = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$_GET['poiid']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
$data[] = $row;

}
		
	$response['success'] = true;
	$response['data'] = $data;

}
echo json_encode($response);
?>
