<?php
require('../db_config.php');

$response = array();
$pkid = $_GET['pkid'];
$sql = "SELECT * FROM tbl_package WHERE pk_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$pkid);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
	$route = array();
	while($row = $result->fetch_assoc()) {
		$route = explode("|",$row['pk_route']);

		$q = implode("," , $route);
		$sql2 = "SELECT * FROM tbl_poi WHERE poi_id IN ($q)";
		$stmt2 = $con->prepare($sql2);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		$routearray = array();
		while($row2 = $result2->fetch_assoc()) {
$poi_photo="../assets/img/poi/".$row2['poi_id'].".jpg";
		if(!file_exists($poi_photo)) {
			$url = $base_url."assets/img/poi/no_image.jpg";
		} else {
			$url = $base_url."assets/img/poi/s/".$row2['poi_id'].".png";
		}
	$row2['poi_photo'] = $url;
				$routearray[] = $row2;




		}
		$routedetail = array();
		foreach($route as $r) {
			for($i = 0;$i < count($route);$i++) {
				if ($r == $routearray[$i]['poi_id']) {
					$routedetail[] = $routearray[$i];

				}
			}
		}
$row['pk_routedetail'] = $routedetail;
$response['success'] = true;
$response['data'] = $row;
	}
}
echo json_encode($response);
?>
