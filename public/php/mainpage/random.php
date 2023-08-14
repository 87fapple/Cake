<?php
require('../db2.php');

$sql = "SELECT e.*, u.uName, c.cImg1 FROM exp AS e
JOIN userinfo AS u ON e.uid = u.uid JOIN cake AS c ON e.cid = c.cid
ORDER BY RAND() LIMIT 3";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$randomData = array();
while ($row = $result->fetch_assoc()) {
    $randomData[] = $row;
}

echo json_encode($randomData); // 將資料轉換為 JSON 格式返回

?>
