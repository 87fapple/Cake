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

// $row =$result->fetch_assoc();
// $image = $row['cImg1'];
// if ($image == null) {
//     $image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
// }
// data:image/jpeg;base64,ooxx
// $mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($image);
// $image_base64 = base64_encode($image);
// $src = "data:image/jpeg;base64,{$image_base64}";
// echo $src;
// $mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($cImg1);
// $image_base64 = base64_encode($cImg1);
// $src1 = "data:{$mine_type};base64,{$image_base64}";
// $src1 = "data:image/jpg;base64,{$image_base64}";
// header("Content-Type: image/jpeg");
// echo '<img src=' . $src . ' style="max-width: 200px" >';

