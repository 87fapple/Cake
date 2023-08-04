<?php
require('../db2.php');
// require('../DB.php');


$cName = $_GET['cName'];

$sql = 'select cName,price,kind,cSize,feature,level,material from cake where cName = ?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $cName);
$stmt->execute();
$result = $stmt->get_result();

// DB::select('select cName,price,kind,cSize,feature,level,material from cake where cName = ?',function($rows)use (&$row){
    // echo('<pre/>');
    // var_dump($rows);
//     $row[]=$rows[0];
// },[$cName]);
$res_json =[];
while ($row =$result->fetch_assoc()) {
    // $res_json = array();
    $res_json[] = $row;
    $res_json = json_encode($res_json);
}
header("Content-Type: application/json");
echo $res_json;
