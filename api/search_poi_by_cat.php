<?php
require('../db_config.php');
$response = array();
$data = array();
$poicatid = $_GET['poicatid'];
$q = $_GET['q'];
$sql = "SELECT * FROM tbl_poi WHERE poi_show = 1 AND poi_cat = $poicatid AND poi_name LIKE '%$q%'ORDER BY poi_name ASC";
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
		$data[] = $row;
	}

	$response['success'] = true;
	$response['data'] = $data;

}
echo json_encode($response);
?>
