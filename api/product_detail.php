<?php
require('../db_config.php');
$response = array();
$cat = trim($_GET['cat']);
if ($cat ==3) {
$sql = "SELECT * FROM tbl_food WHERE fd_poiid = ?";
}

if ($cat ==1) {
$sql = "SELECT * FROM tbl_room WHERE rm_poiid = ?";
}
if ($cat ==4) {
$sql = "SELECT * FROM tbl_product WHERE pro_poiid = ?";
}

$stmt = $con->prepare($sql);
$stmt->bind_param("i",$_GET['poiid']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
	if ($cat == 1) {
	$name = $row['rm_size'];
	switch($name) {
		case "s":$name="ห้องขนาดเล็ก"; break;
		case "m":$name="ห้องขนาดกลาง"; break;
		case "l":$name="ห้องขนาดใหญ่"; break;
		default : break;
	}
	$price = $row['rm_price'];
	$photo = $base_url.'assets/img/all/bedsm.png';
}

if ($cat == 3) {
$name = $row['fd_name'];
$price = $row['fd_price'];
$photo = $base_url.'assets/img/food/'.$row['fd_poiid'].'/'.$row['fd_id'].'.png';
}
if ($cat == 4) {
$name = $row['pro_name'];
$price = $row['pro_price'];
$photo = $base_url.'assets/img/otop/product/'.$row['pro_poiid'].'/'.$row['pro_id'].'.png';
}

$row['name'] = $name;
$row['price'] = $price;
$row['photo'] = $photo;
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
