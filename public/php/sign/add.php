<?php session_start(); ?>
<?php
// if (!$_COOKIE['token']) {
//     header('Location: login.php');
//     die();
// }
require('../DB.php');

$cName = $_REQUEST['pname'];
$level = $_REQUEST['level'];
$kind = $_REQUEST['kind'];
$cSize = $_REQUEST['cSize'];
$price = $_REQUEST['price'];
$feature = $_REQUEST['feature'];
$cImg1 = $_FILES['cImg1']['tmp_name'];
$cImg2 = $_FILES['cImg2']['tmp_name'];
$meterial= '我好帥';

$c1 = file_get_contents($cImg1);
$c2 = file_get_contents($cImg2);
DB::insert('insert into cake(cName,price,kind,cSize,cImg1,cImg2,feature,level,meterial)
value(?,?,?,?,?,?,?,?,?)',[$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$meterial]);

header('location:/Cake/public/php/sign/add.html');

//查看圖片內容
// if (($_FILES["cImg1"]["type"] == "image/gif")
// || ($_FILES["cImg1"]["type"] == "image/jpeg")
// || ($_FILES["cImg1"]["type"] == "image/jpg"))

// if ($_FILES["cImg1"]["error"] > 0) {
//     echo "Return Code: " . $_FILES["cImg1"]["error"] . "<br />";
// } else {
//     echo "檔名: " . $_FILES["cImg1"]["name"] . "<br />";
//     echo "檔案型別: " . $_FILES["cImg1"]["type"] . "<br />";
//     echo "檔案大小: " . ($_FILES["cImg1"]["size"] / 1024) . " Kb<br />";
//     echo "快取檔案: " . $_FILES["cImg1"]["tmp_name"] . "<br />";
// }

