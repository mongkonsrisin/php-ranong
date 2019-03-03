<?php
require('../db_config.php');
$response = array();
$data = array();
$sql = "SELECT * FROM tbl_package";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
		$pk_photo = $base_url."assets/img/package/".$row['pk_id']."/preview".$row['pk_id'].".png";
		$row['pk_photo'] = $pk_photo;
		$data[] = $row;
	}

	$response['success'] = true;
	$response['data'] = $data;

}
echo json_encode($response);
?>
