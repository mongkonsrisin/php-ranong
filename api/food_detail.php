<?php
require('../db_config.php');
$response = array();
$sql = "SELECT * FROM tbl_food WHERE fd_poiid = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$_GET['poiid']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
$row['fd_photo'] = $base_url.'assets/img/food/'.$row['fd_poiid'].'/'.$row['fd_id'].'.png';
$data[] = $row;

}
		
	$response['success'] = true;
	$response['data'] = $data;

} else {

$response['success'] = false;
	$response['data'] = "Not found";
}
echo json_encode($response);
?>
