<?php
function checkpackage($id){
    global $con;
    $sql = "SELECT count(*) as c FROM tbl_package WHERE pk_route like '%$id%'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['c'];
}
function checkroom($id){
    global $con;
    $sql = "SELECT count(*) as c FROM tbl_room WHERE rm_poiid = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['c'];
}
function checkfood($id){
    global $con;
    $sql = "SELECT count(*) as c FROM tbl_food WHERE fd_poiid = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['c'];
}
function checkproduct($id){
    global $con;
    $sql = "SELECT count(*) as c FROM tbl_product WHERE pro_poiid = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['c'];
}
function checkpin($id){
    global $con;
    $sql = "SELECT count(*) as c FROM tbl_poi WHERE poi_pin = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['c'];
}
function checkactivityicon($id){
    global $con;
    $sql = "SELECT count(*) as c FROM tbl_activity WHERE act_icon = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['c'];
}
function checkactivity($id){
    global $con;
    $sql = "SELECT count(*) as c FROM tbl_poi WHERE poi_id = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['c'];
}
?>