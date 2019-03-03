<?php
require ("../config/session.php");
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
require ("../config/dbconfig.php");
$routes = $_SESSION['route'];
$routes2 = array();
for ($i = 0; $i < count($routes); $i++) {
  $sql = 'SELECT * FROM tbl_poi p LEFT JOIN tbl_category c ON p.poi_cat = c.cat_id WHERE poi_id=?';
  $stmt = $con->prepare($sql);
  $stmt->bind_param("i",$routes[$i]);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $routes2[$i]['cat'] = $row['cat_name'];
  $routes2[$i]['name'] = $row['poi_name'];
}
echo json_encode($routes2);
$con->close();

?>
