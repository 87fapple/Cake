<?php session_start(); ?>
<?php

require('../db2.php');

$email = $_REQUEST['email'];
$pwd = $_REQUEST['pwd'];

$sql = 'call login(?,?)';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ss', $email, $pwd);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$token = $row['token'];

$nextPage = $row['result'];
if ($nextPage === '/Cake/public/history.php') {
    setcookie('token', $token,time() +120,"/");
    setcookie('welcome',$nextPage,time() +120,"/");
}
header("Location:{$nextPage}");
?>
