<?php
require_once('../db2.php');

$sql = 'SELECT * FROM cake ORDER BY price DESC';
$result = $mysqli->query($sql);

$cakes = array();

while ($row = $result->fetch_assoc()) {
    $cakes[] = $row;
}

// 设置响应头部，指定返回的是 JSON 格式的数据
header('Content-Type: application/json');

// 将排序后的数据转换为 JSON 格式并返回给 AJAX 请求
echo json_encode($cakes);
?>