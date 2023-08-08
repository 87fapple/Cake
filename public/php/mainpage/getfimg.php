<?php
require('../db2.php');

// $bid = $_REQUEST['bid'];

$sql = "select bodyImg, body from binfo where bid = 1";
$stmt = $mysqli->prepare($sql);
// $stmt->bind_param('s', $bid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $image = $row['bodyImg'];
    $text = $row['body'];
}


$data = array(
    'image' => base64_encode($image),
    'text' => $text
);

echo json_encode($data);