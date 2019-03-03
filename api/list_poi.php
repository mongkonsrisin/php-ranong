<?php
require('../db_config.php');
$response = array();
$data = array();
$sql = "SELECT * FROM tbl_poi LEFT JOIN tbl_category ON tbl_poi.poi_cat=tbl_category.cat_id ORDER BY poi_name ASC";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
		$poi_photo="../assets/img/poi/".$row['poi_id'].".jpg";
		if(!file_exists($poi_photo)) {
			$url = $base_url."assets/img/poi/no_image.jpg";
		} else {
			$url = $base_url."assets/img/poi/".$row['poi_id'].".jpg";
		}
		$row['poi_photo'] = $url;
		$data[] = $row;
	}

	$response['success'] = true;
	$response['data'] = $data;

}
echo json_encode($response);
?>
