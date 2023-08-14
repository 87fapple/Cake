<?php
require('../php/db2.php');

$cid = $_GET['cid'];
$remove = $_GET['remove'];

if($remove==0){
    $sql = "update cake set remove = '1' where cid = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $cid);
    $stmt->execute();
}else{
    $sql = "update cake set remove = '0' where cid = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $cid);
    $stmt->execute();
}

header('location:/Cake/public/CMS/mgt_product.php');