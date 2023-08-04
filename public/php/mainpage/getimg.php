<?php
require('../db2.php');

$bid = $_REQUEST['bid'];

$sql = "select * from binfo where bid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $bid);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while($row = $result->fetch_assoc()) {
    $images[] = $row['Img1'];
    $images[] = $row['Img2'];
    $images[] = $row['Img3'];
    $images[] = $row['Img4'];
    // ...
}

foreach ($images as $imageData) {
    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" />';
}