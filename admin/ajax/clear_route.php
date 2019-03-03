<?php
require ("../config/session.php");
if(!isset($_SESSION['user'])) {
  echo '<meta http-equiv="refresh" content="0;url=login.php">';
  exit();
}
require ("../config/dbconfig.php");

$_SESSION['route'] = array();

$con->close();

?>
