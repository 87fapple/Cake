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

if ($nextPage === 'history.html') {
    header("Location:/Cake/public/history.html");
} else {
    header("Location:error.html");
}
?>
