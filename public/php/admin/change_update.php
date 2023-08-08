<?php
require_once('../DB.php');
require_once('../db2.php');

$cName = $_REQUEST['cName'];
$level = $_REQUEST['level'];
$kind = $_REQUEST['kind'];
$cSize = $_REQUEST['cSize'];
$price = $_REQUEST['price'];
$feature = $_REQUEST['feature'];
$material = $_REQUEST['material'];
$change = $_REQUEST['change_cName'];
$cImg1 = $_FILES['cImg1']['tmp_name'];
$cImg2 = $_FILES['cImg2']['tmp_name'];

if ($_FILES["cImg1"]["error"] > 0 or $_FILES["cImg2"]["error"] > 0) {
    echo "Return Code: " . $_FILES["cImg1"]["error"] . "<br />";
    echo "Return Code: " . $_FILES["cImg2"]["error"] . "<br />";
} else {
    move_uploaded_file($cImg1,"../../../image/cake_add/".$_FILES["cImg1"]["name"]);
    $c1 = "../../../image/cake_add/".$_FILES["cImg1"]["name"];
    echo $c1 ."<br/>";
    move_uploaded_file($cImg2,"../../../image/cake_add/".$_FILES["cImg2"]["name"]);
    $c2 = "../../../image/cake_add/".$_FILES["cImg2"]["name"];
    echo $c2;
}

// DB::update("update cake set cName = ? ,price = ? ,kind = ? ,cSize = ? ,cImg1 = ? ,cImg2 = ? ,feature = ? ,level = ? ,material = ?  where  = ? ",[$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$material,$change]);
$sql="update cake set cName = ? ,price = ? ,kind = ? ,cSize = ? ,cImg1 = ? ,cImg2 = ? ,feature = ? ,level = ? ,material = ?  where cName = ?";
$stmt=$mysqli->prepare($sql);
$stmt->bind_param('ssssssssss',$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$material,$change);
$stmt->execute();

header("location:/Cake/public/php/admin/change_demo.php"); 
