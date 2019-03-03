<?php
require('../db_config.php');
?>
<html><head><meta charset="UTF-8"></head><body>
<?php
$data = array();
$sql = "SELECT * FROM tbl_poi LEFT JOIN tbl_category ON tbl_poi.poi_cat=tbl_category.cat_id where poi_show=1 ORDER BY tbl_poi.poi_cat, poi_name ASC";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
echo "<table border='1'>";
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
		echo "<tr><td><table>";
		echo "<tr><td>(ประเภท - ".$row["cat_name"].") - id = ".$row["poi_id"]." : ".$row["poi_name"]."</td></tr>";
		$poi_photo="../assets/img/poi/m/".$row["poi_id"].".png";
		echo "<tr><td>ภาพหลัก : <br><a href='$poi_photo' target='_blank'><img src='$poi_photo' height='100'></a></td></tr>";
		echo "<tr><td>ภาพในอัลบั้ม : <br>";
		
		$directory = "../assets/img/photo/".$row["poi_id"]."/"; // dir location
		$allpics = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
		if($allpics != false)
		{
			$filecount = count($allpics);
			for($i=0;$i<$filecount;$i++)
			{
				$pic=$allpics[$i];
				echo "<a href='$pic' target='_blank'><img src='$pic' height='100'></a>&nbsp; ";
			}
		}
		echo "</td></tr>";
		echo "</table></td></tr>";
	}
}
echo "</table>";

/*
$poi_photo="../assets/img/poi/s/".$poiid.".png";
if(file_exists($poi_photo))
{
	$image_gallery=array();
	$image_gallery[0]=$base_url."assets/img/poi/s/".$poiid.".png";
	$directory = "assets/img/photo/".$_GET['id']."/"; // dir location
	$allpics = glob("../".$directory . "*.{jpg,png,gif}",GLOB_BRACE);
	if($allpics != false)
	{
		$filecount = count($allpics);
		for($i=0;$i<$filecount;$i++)
			$image_gallery[$i+1]=$base_url.str_replace("../","",$allpics[$i]);
	}
	$response['success'] = true;
	$response['data'] = $image_gallery;
}
echo json_encode($response);
*/
?>
</body></html>