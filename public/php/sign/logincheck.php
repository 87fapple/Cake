<?php session_start(); ?>
<?php

require('../db2.php');

$email = $_GET['email'];
$pwd = $_GET['pwd'];


$sql = 'call login(?,?)';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ss', $email, $pwd);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$token = $row['token'];

$nextPage = $row['result'];
if ($nextPage === '/Cake/public/history.php') {
    setcookie('token', $token, time() + 12000, "/");
    setcookie('welcome', $nextPage, time() + 1200, "/");
    echo 100;
    // header("Location:{$nextPage}");
    
} else {
    header('Content-Type: text/html; charset=utf-8');
    echo "<span style=color:red;>帳號或密碼輸入錯誤 </span>";
}

?>
