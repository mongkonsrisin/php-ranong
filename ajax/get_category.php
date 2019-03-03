<?php
require('../db_config.php');
if(isset($_GET['type']))
{
	if(trim($_GET['type'])== 0)
	$type = "" ;
	else 
	$type = " and poi_type= ".$_GET['type'] ;
}
else $type = "" ;
$sql = "SELECT poi.*,sub_thainame, dis_thainame, pro_thainame, sub_zipcode 
FROM tbl_poi poi 
left join tbl_subdistrict s on (poi.poi_subdistrict = s.sub_id)  
left join tbl_district d  on(s.sub_amid=d.dis_id and s.sub_proid=d.dis_proid) 
left join tbl_province p on(s.sub_proid=p.pro_geocode) 
WHERE poi_lat!='' and poi_lng!='' and poi_cat=? $type  and poi_show = 1
ORDER BY poi_lat;";




$stmt = $con->prepare($sql);
$stmt->bind_param("i",$_GET['cat']);

$stmt->execute();
$result = $stmt->get_result();
$data = array();
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>