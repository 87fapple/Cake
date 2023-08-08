<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require_once('../DB.php');

$token = $_COOKIE['token'];

$eText = $_REQUEST["message"] ?? null;
$cid = $_REQUEST["cid"] ?? null;
$contents = [];

// var_dump($_REQUEST);

if (!$eText || !$cid) {
    echo "資料有空";
    die();
}

// var_dump($_REQUEST);
DB::select("call createExp(?, ?, ?)", function ($rows) use (&$getNum) {
    if (isset($rows[0]['myEid'])) {
        $getNum = $rows[0]['myEid'];
    }
}, [$token, $eText, $cid]);

if (isset($getNum, $_FILES["file"]["name"], $_FILES["file"]["tmp_name"])) {
    $imageName = $_FILES["file"]["name"];
    $imageTmp = $_FILES["file"]["tmp_name"];
    if (!empty($imageName[0]) && !empty($imageTmp[0])) {

        for ($i = 0; $i < count($imageName); $i++) {
            $contents[$i] = file_get_contents($imageTmp);
        }
    }
}

// $contents = [];

// for ($i = 0; $i < count($imageName); $i++) {
//     $contents[$i] = file_get_contents($imageTmp);
// }

// $cid = $_REQUEST["cid"];




?>