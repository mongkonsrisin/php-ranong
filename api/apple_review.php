<?php
require('../db_config.php');
$response = array();
$sql = "SELECT cfg_value FROM tbl_config WHERE cfg_key = 'APPLE_IN_REVIEW'";
$stmt = $con->prepare($sql);

$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$response['success'] = true;
		$response['data'] = intval($row['cfg_value']);
}
echo json_encode($response);
?>
