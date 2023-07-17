<?php
require ('../db2.php');

$uname = $_REQUEST['uname'];
$email = $_REQUEST['email'];
$pwd = $_REQUEST['pwd'];
$tel = $_REQUEST['tel'];

$sql = "insert into userinfo (uname,pwd,email,tel) values(?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ssss',  $uname,$pwd, $email, $tel);
$stmt->execute();


?>