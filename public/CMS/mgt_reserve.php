<?php $title = 'CMS Reserve Management'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '預約總覽'; ?>
<?php $currentIcon = 'receipt_long'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>


<?php
require_once('../php/db2.php');

$sql = "SELECT o.*, u.uName,s.location FROM orders AS o
LEFT JOIN userinfo AS u  ON o.uid = u.uid LEFT JOIN store s ON o.sid = s.sid";
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

    .container .title {
        width: 90%;
        margin: 0 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .main_table {
        border-collapse: collapse;
        margin: 12px 5% 80px;
        font-size: 14px;
        font-family: sans-serif;
        white-space: nowrap;
        width: 90%;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .main_table thead tr {
        background-color: #885500;
        color: #ffffff;
        font-size: 16px;
        text-align: left;
    }

    .main_table th,
    .main_table td {
        padding: 12px 15px;
    }

    .main_table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .main_table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .main_table tbody tr:last-of-type {
        border-bottom: 2px solid #ffa237;
    }

    .main_table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    .main_table tbody tr:hover {
        background-color: #e8e8e8;
        cursor: pointer;
    }

    .main_table tbody tr td a {
        text-decoration: none;
        color: #111;
        background-color: #ffa237;
        border: 1px solid #ffa237;
        border-radius: 6px;
        padding: 4px 12px;
    }

    .main_table tbody tr td a:hover {
        background-color: #ffcb53;
        border: 1px solid #ffcb53;
        cursor: pointer;
    }

    .main_table tbody tr td a:last-child {
        margin-left: 16px;
    }
</style>

<body>
    <div class="container">
        <div class="title"><h2>預約總覽</h2></div>

        <table class="main_table">
            <thead>
                <tr>
                    <th />編號
                    <th />預約人
                    <th />地點
                    <th />預約日期
                    <th />預約時間
                    <th />總人數
                    <th />同行人數
                    <th />
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ordersByOid as $oid => $orders) {
                    echo '<tr /><td />' . $oid . '</td>';
                    foreach ($orders as $order) {
                        echo '<td />' . $order['uName'] .
                            '<td />' . $order['location'] .
                            '<td />' . $order['reserveTime'] .
                            '<td />' . $order['reserveDate'] .
                            '<td />' . $order['people'] .
                            '<td />' . $order['companion'] .
                            '<td align="right" width="100px" />
                                <a href="change_reserve.php?oToken=' . $order['oToken'] . '" )">修改</a>
                            </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>