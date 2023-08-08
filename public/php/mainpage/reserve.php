<?php
require('../db2.php');

$sql = "SELECT o.*, u.uName,s.location FROM orders AS o
JOIN userinfo AS u  ON o.uid = u.uid JOIN store s ON o.sid = s.sid";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$ordersByOid = array();

// 將資料以 oid 分組存儲在陣列中
while ($row = $result->fetch_assoc()) {
    $oid = $row['oid'];
    if (!isset($ordersByOid[$oid])) {
        $ordersByOid[$oid] = array();
    }
    $ordersByOid[$oid][] = $row;
}

// 顯示分組後的資料
foreach ($ordersByOid as $oid => $orders) {
    echo "訂單編號: $oid<br>";
    foreach ($orders as $order) {
        echo "預約人: {$order['uName']}, 地點: {$order['location']}, 時間: {$order['reserveTime']}, 日期: {$order['reserveDate']}, 人數: {$order['people']}, 同行人數: {$order['companion']}<br>";
        // 這裡可以顯示其他你想要的資料項目
    }
    echo "<br>";
}

$stmt->close();
$mysqli->close();