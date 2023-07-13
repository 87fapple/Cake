<?php
require ('db2.php');

$cname = $_REQUEST['cname'];
$uid = $_REQUEST['uid'];
$pwd = $_REQUEST['pwd'];
$email = $_REQUEST['email'];
$tel = $_REQUEST['tel'];

$sql = "insert into userinfo (uid,cname,pwd,email,tel) values(?,?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sssss', $uid, $cname,$pwd, $email, $tel);
$stmt->execute();


?>