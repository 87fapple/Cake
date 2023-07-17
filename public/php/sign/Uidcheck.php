<?php
require('../db2.php');
$email = $_REQUEST['email'];
$sql="SELECT count(email) FROM userinfo WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s',$email);
$stmt->execute();
$result = $stmt->get_result();
$row =$result->fetch_row();

$count = intval($row[0]);

if($count > 0){
    header('Content-Type: text/html; charset=utf-8');
    echo "<span style=color:lightgreen;> V </span>";
}else{
    header('Content-Type: text/html; charset=utf-8');
    echo "<span style=color:red;> X </span>";
}