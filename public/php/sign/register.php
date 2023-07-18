<?php
require ('../db2.php');

$uname = $_REQUEST['uname'];
$email = $_REQUEST['email'];
$pwd = $_REQUEST['pwd'];
$phone = $_REQUEST['phone'];

$sql = "insert into userinfo (uname,pwd,email,phone) values(?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ssss',  $uname,$pwd, $email, $phone);
$stmt->execute();


?>