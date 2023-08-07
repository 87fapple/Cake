<?php
require("../DB.php");
require("../db2.php");
// var_dump($_REQUEST);

$eid = $_REQUEST["eid"];

// DB::select("select eImg from expimage eImg join exp e on e.eid = eImg.eid where eImg.eid = ?", function ($rows) {
//     // echo json_encode($rows);
//     // var_dump($rows);
//     $image = $rows["eImg"];
//     if ($image == null){
//         $image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
//     }

//     $mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($image);
//     $image_base64 = base64_encode($image);
//     $src = "data:{$mine_type};base64,{$image_base64}";
//     header('content-type: image/jpeg');

//     echo ($src);
//     // var_dump($src);
// }, [$eid]);

$sql = 'select eImg from expimage eImg join exp e on e.eid = eImg.eid where eImg.eid = ?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $eid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$image = $row['eImg'];

// echo $image;
if ($image == null) {
    $image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
}
// data:image/jpeg;base64,ooxx
$mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($image);
$image_base64 = base64_encode($image);
$src = "data:{$mine_type};base64,{$image_base64}";

// echo $image;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="<?= $src?>" alt="">
</body>
</html>