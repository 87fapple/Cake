<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.php');
    die();
}

require ('../DB.php');
$pwd = $_REQUEST['pwd'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$uName = $_REQUEST['uname'];
$token = $_COOKIE['token'];
$rpwd = $_REQUEST['cfrpwd'];


if(strlen($pwd)==0){
DB::update("update userinfo set uName = ? ,email = ? ,phone = ? where token = ?",[$uName,$email,$phone,$token]);
}else{
DB::update("update userinfo set uName = ? ,email = ? ,phone = ? ,pwd = ? where token = ?",[$uName,$email,$phone,$pwd,$token]);
}
header('location:/Cake/public/member.php');