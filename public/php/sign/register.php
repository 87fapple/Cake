<?php
require ('../DB.php');

$uname = $_REQUEST['uname'];
$email = $_REQUEST['email'];
$pwd1 = $_REQUEST['pwd1'];
$pwd2 = $_REQUEST['pwd2'];
$phone = $_REQUEST['phone'];


DB::insert("insert into userinfo (uname,pwd,email,phone) values(?,?,?,?)",[$uname,$pwd1, $email, $phone]);

header('location:/Cake/public/login.html');
?>