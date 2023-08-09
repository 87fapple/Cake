<?php
require('../db2.php');
// require('../DB.php');


$cName = $_GET['cName'];

$sql = "select cName,price,kind,cSize,feature,level,material, cImg1,cImg2 from cake where cName = '季節水果蛋糕'";
$stmt = $mysqli->prepare($sql);
// $stmt->bind_param('s', $cName);
$stmt->execute();
$result = $stmt->get_result();

$res_json =[];
while ($row =$result->fetch_assoc()) {
    $res_json[] = $row;
}
$res_json = json_encode($res_json);
header("Content-Type: application/json");
echo $res_json;