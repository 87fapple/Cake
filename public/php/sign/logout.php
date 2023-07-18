<?php
require ('../db.php');
$token = $_COOKIE['token'];

$sql='call logout(?)';
$stmt=$mysqli->prepare($sql);
$stmt->bind_param('s',$token);
$stmt->execute();


header('location:/Cake/public/login.html' );
?>