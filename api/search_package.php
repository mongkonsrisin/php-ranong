<?php

function strdate2intDate($strdate)
{ // convert String Thai Date to Integer Date as Number
 $strdate=str_replace("-","/",$strdate);
 list($day,$month, $year) = explode('/', $strdate);
 $year=(int)$year-543;
 return  number_format(((mktime(7, 0, 0, (int)$month,(int)$day, (int)$year)/86400)+719163),0,'','');
}



require('../db_config.php');
$response = array();
$data = array();




        $dateStart = $_GET['datestart'];
        $dateEnd = $_GET['dateend'];
        $category = $_GET['category'];
        $type = $_GET['type'];
        $budget = $_GET['budget'];
        $people = $_GET['people'];

        $dateStart  = strdate2intDate($dateStart);
        $dateEnd = strdate2intDate($dateEnd);

      

        $date = $dateEnd - $dateStart + 1;

 
        if($type==1) $condition=" and pk_car=1";
        else if($type==2) $condition=" and pk_motorcycle=1";
        else if($type==3) $condition=" and pk_bicycle=1";
        else $condition="";

        if($category==1) $condition2=" and pk_category=1";
        else if($category==2) $condition2=" and pk_category=2";
        else $condition2="";

        if($date>0) $condition.=" and pk_days<=($date)";
      
      $sql = "SELECT * FROM tbl_package WHERE pk_budget<=($budget/$people) $condition $condition2";




$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
	while($row = $result->fetch_assoc()) {
		$pk_photo = $base_url."assets/img/package/s/".$row['pk_id'].".png";
		$row['pk_photo'] = $pk_photo;
		$data[] = $row;
	}

	$response['success'] = true;
	$response['data'] = $data;


echo json_encode($response);
?>
