<?php $title = 'CMS Order Management'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '訂單總覽'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>


<?php
require_once('../php/db2.php');

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
// foreach ($ordersByOid as $oid => $orders) {
//     echo "訂單編號: $oid<br>";
//     foreach ($orders as $order) {
//         echo "預約人: {$order['uName']}, 地點: {$order['location']}, 時間: {$order['reserveTime']}, 日期: {$order['reserveDate']}, 人數: {$order['people']}, 同行人數: {$order['companion']}<br>";
//         // 這裡可以顯示其他你想要的資料項目
//     }
//     echo "<br>";
// }

$stmt->close();
$mysqli->close();

?>

<style>
    .container {
        width: calc(100% - 200px);
        position: relative;
        top: 52px;
        left: 200px;
    }

    .order-table {
        border-collapse: collapse;
        margin: 32px 5%;
        font-size: 14px;
        font-family: sans-serif;
        white-space: nowrap;
        width: 90%;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .order-table thead tr {
        background-color: #885500;
        color: #ffffff;
        font-size: 16px;
        text-align: left;
    }

    .order-table th,
    .order-table td {
        padding: 12px 15px;
    }

    .order-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .order-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .order-table tbody tr:last-of-type {
        border-bottom: 2px solid #ffa237;
    }

    .order-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    .order-table tbody tr:hover {
        background-color: #e8e8e8;
        cursor: pointer;
    }

    .order-table tbody tr td button {
        background-color: #ffa237;
        border: 1px solid #ffa237;
        border-radius: 6px;
        padding: 4px 12px;
    }

    .order-table tbody tr td button:hover {
        background-color: #ffcb53;
        border: 1px solid #ffcb53;
        cursor: pointer;
    }

    .order-table tbody tr td button:last-child {
        margin-left: 16px;
    }
</style>

<body>
    <div class="container">
        <table class="order-table">
        <thead>
            <tr>
                <th>訂單編號</th>
                <th>預約人</th>
                <th>地點</th>
                <th>預約日期</th>
                <th>預約時間</th>
                <th>總人數</th>
                <th>同行人數</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                    foreach ($ordersByOid as $oid => $orders) {
                        echo '<tr><td>'.$oid.'</td>';
                        foreach ($orders as $order) {
                            echo '<td>'.$order['uName'].'</td>
                                <td>'.$order['location'].'</td>
                                <td>'.$order['reserveTime'].'</td>
                                <td>'.$order['reserveDate'].'</td>
                                <td>'.$order['people'].'</td>
                                <td>'.$order['companion'].'</td>
                                <td>
                                    <button>修改</button>
                                    <button>取消</button>
                                </td>';
                            // 這裡可以顯示其他你想要的資料項目
                        }
                        echo '</tr>';
                    }
                ?> 
            <!-- and so on... -->
        </tbody>
        </table>

    </div>
</body>