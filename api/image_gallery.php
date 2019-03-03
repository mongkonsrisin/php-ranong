<?php
require('../db_config.php');
$response = array();
$poiid=$_GET['id'];
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
?>