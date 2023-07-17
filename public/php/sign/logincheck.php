<?php session_start(); ?>
<?php
require('../db2.php');

$email = $_REQUEST['email'];
$pwd = $_REQUEST['pwd'];

$sql = 'select count(*) from userinfo where email = ? AND pwd =?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ss', $email, $pwd);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$count = $row[0];
// echo $count;
// $uid = $row['uid'];
// $pwd = $row['pwd'];
// echo $row['uid'];
// $result = $stmt->get_result();
// $row = $result ->fetch_assoc();
if ($count === 1) {
    header("Location:welcome.html");
} else {
    header("Location:error.html");
}
?>
