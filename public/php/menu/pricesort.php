<?php
require_once('../db2.php');

// 获取从前端传递过来的排序方式参数
$sortType = $_REQUEST['sortType'];

// 根据排序方式参数生成不同的排序SQL语句
if ($sortType === 'asc') {
    $sql = 'SELECT * FROM cake ORDER BY price ASC';
} else if ($sortType === 'desc') {
    $sql = 'SELECT * FROM cake ORDER BY price DESC';
} else {
    // 默认按价格升序排序
    $sql = 'SELECT * FROM cake ORDER BY price ASC';
}

$result = $mysqli->query($sql);

$cakes = array();

while ($row = $result->fetch_assoc()) {
    $cakes[] = $row;
}

// 设置响应头部，指定返回的是 JSON 格式的数据
header('Content-Type: application/json');

// 将查询结果转换为 JSON 格式并返回给 AJAX 请求
echo json_encode($cakes);
?>