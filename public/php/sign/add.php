<?php session_start(); ?>
<?php
// if (!$_COOKIE['token']) {
//     header('Location: login.php');
//     die();
// }
require_once('../DB.php');
require_once('../db2.php');
// require_once('../image.php');

$cName = $_REQUEST['pname'];
$level = $_REQUEST['level'];
$kind = $_REQUEST['kind'];
$cSize = $_REQUEST['cSize'];
$price = $_REQUEST['price'];
$feature = $_REQUEST['feature'];
$material = $_REQUEST['material'];

$c1 = $_FILES['cImg1']['tmp_name'];
// $c1=new Image($cImg1);
// $c1->resize(400,400,'fill');
// list($c1) = $photo->getImageSrc('thumb');
$cImg2 = $_FILES['cImg2']['tmp_name'];



$c1 = file_get_contents($c1);
$c1 = base64_encode($c1);
$c2 = file_get_contents($cImg2);

$sql="insert into cake(cName,price,kind,cSize,cImg1,cImg2,feature,level,material)
value(?,?,?,?,?,?,?,?,?)";
$stmt=$mysqli->prepare($sql);
$stmt->bind_param('sssssssss',$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$material);
$stmt->send_long_data(4, $c1);
$stmt->send_long_data(5, $c2);
$stmt->execute();


// DB::insert('insert into cake(cName,price,kind,cSize,cImg1,cImg2,feature,level,material)
// value(?,?,?,?,?,?,?,?,?)',[$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$material]);



header('location:/Cake/public/php/sign/add2.html');

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

