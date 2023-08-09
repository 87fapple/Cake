<?php
require("../DB.php");
require("../db2.php");
// var_dump($_REQUEST);

$eid = $_REQUEST["eid"];

// DB::select("select eImg from expimage eImg join exp e on e.eid = eImg.eid where eImg.eid = ?", function ($rows) {
    // echo json_encode($rows);
    // var_dump($rows);
    // $image = $rows["eImg"];
    // if ($image == null){
    //     $image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
    // }

    // $mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($image);
    // $image_base64 = base64_encode($image);
    // $src = "data:{$mine_type};base64,{$image_base64}";
    // header('content-type: image/jpeg');

    // echo ($src);
    // var_dump($src);
// }, [$eid]);

$sql = 'select eImg from expimage where eid = ?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $eid);
$stmt->execute();
$result = $stmt->get_result();
$i = 0;
while ($row = $result->fetch_assoc()) {
    $eImgData[] = $row['eImg'];
    if (!empty($eImgData)) {
        $image[$i] = $eImgData[$i];
        $mine_type[$i] = (new finfo(FILEINFO_MIME_TYPE))->buffer($image[$i]);
        $image_base64[$i] = base64_encode($image[$i]);
        $src[$i] = "data:{$mine_type[$i]};base64,{$image_base64[$i]}";
    }else{
        echo "none";
    }
    $i++;
}

echo json_encode($src);
