<?php
require('../db_config.php');
$response = array();
$sql = "SELECT * FROM tbl_config WHERE cfg_key = ?";
$stmt = $con->prepare($sql);
$key = "";

switch(trim($_GET['platform'])) {
	case 'ios' : $key = 'IOS_VERSION'; break;
	case 'android' : $key = 'ANDROID_VERSION'; break;
	default : $key = ''; break;
}

$stmt->bind_param("s",$key);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$response['success'] = true;
		$response['data'] = $row;
}
echo json_encode($response);
?>
