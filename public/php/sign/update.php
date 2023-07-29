<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: login.php');
    die();
}


require ('../db2.php');
$pwd = $_REQUEST['pwd'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$uName = $_REQUEST['uname'];
$token = $_COOKIE['token'];

$sql="update userinfo set uName = ? ,email = ? ,phone = ? where token = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ssss',$uName,$email,$phone,$token);
$stmt->execute();

header('location:/Cake/public/member.php');