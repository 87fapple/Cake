<?php session_start(); ?>
<?php

session_destroy();
setcookie('token', '',time() -1, "/");
setcookie('welcome', '',time() -1, "/");


require('../db2.php');
$token = $_COOKIE['token'];

$sql = 'call logout(?)';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $token);
$stmt->execute();


header('location:/Cake/public/login.html');
?>