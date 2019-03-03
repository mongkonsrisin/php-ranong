<?php
require('../db_config.php');
$response = array();
$data = array();
$poicatid = $_GET['poicatid'];
$sql = "SELECT poi_id,poi_name,poi_lat,poi_lng,poi_pin FROM tbl_poi WHERE poi_show = 1 AND (poi_cat = $poicatid or poi_id=111) AND poi_lat !='' AND poi_lng !=''";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
		$poi_photo="../assets/img/poi/s/".$row['poi_id'].".png";
		if(!file_exists($poi_photo)) {
			$url = $base_url."assets/img/poi/no_image.jpg";
		} else {
			$url = $base_url."assets/img/poi/s/".$row['poi_id'].".png";
		}
		$row['poi_photo'] = $url;
		$row['lat'] = doubleval($row['poi_lat']);
		$row['lng'] = doubleval($row['poi_lng']);
		$row['pin'] = 'pin'.$row['poi_pin'].'.png';
		$data[] = $row;
	}
	$response['success'] = true;
	$response['data'] = $data;
}
echo json_encode($response);
?>