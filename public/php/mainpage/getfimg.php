<?php
require('../db2.php');

// $bid = $_REQUEST['bid'];

$sql = "select Img5, body from binfo where act = 1";
$stmt = $mysqli->prepare($sql);
// $stmt->bind_param('s', $bid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $image = $row['Img5'];
    $text = $row['body'];
}


$data = array(
    'image' => base64_encode($image),
    'text' => $text
);

echo json_encode($data);