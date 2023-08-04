<?php
require('../db2.php');

$sql = "SELECT e.*, u.uName FROM exp AS e
JOIN userinfo AS u ON e.uid = u.uid
ORDER BY RAND() LIMIT 6";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$randomData = array();
while ($row = $result->fetch_assoc()) {
    $randomData[] = $row;
}

echo json_encode($randomData); // 將資料轉換為 JSON 格式返回

?>
