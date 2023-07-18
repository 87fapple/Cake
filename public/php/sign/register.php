<?php
require ('../db2.php');

$uname = $_REQUEST['uname'];
$email = $_REQUEST['email'];
$pwd1 = $_REQUEST['pwd1'];
$pwd2 = $_REQUEST['pwd2'];
$phone = $_REQUEST['phone'];



$sql = "insert into userinfo (uname,pwd,email,phone) values(?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ssss',  $uname,$pwd1, $email, $phone);
$stmt->execute();


?>