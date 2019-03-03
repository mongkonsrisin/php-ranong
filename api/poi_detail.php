<?php
require('../db_config.php');
$response = array();
$sql = "SELECT poi.*,sub_thainame, dis_thainame, pro_thainame, sub_zipcode  FROM tbl_poi poi left join tbl_subdistrict s on (poi.poi_subdistrict = s.sub_id)  left join tbl_district d  on(s.sub_amid=d.dis_id and s.sub_proid=d.dis_proid) left join tbl_province p on(s.sub_proid=p.pro_geocode) WHERE poi.poi_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$_GET['poiid']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0)
{
		$row = $result->fetch_assoc();
		$poi_photo="../assets/img/poi/s/".$row['poi_id'].".png";
		if(!file_exists($poi_photo)) {
			$url = $base_url."assets/img/poi/no_image.jpg";
		} else {
			$url = $base_url."assets/img/poi/s/".$row['poi_id'].".png";
		}
	$row['poi_photo'] = $url;
	$response['success'] = true;
	$response['data'] = $row;

}
echo json_encode($response);
?>
