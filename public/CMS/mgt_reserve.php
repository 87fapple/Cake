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

    .arrow {
        border: solid #eee;
        border-width: 0 3px 3px 0;
        display: inline-block;
        margin-bottom: 2px;
        margin-left: 4px;
        padding: 3px;
    }

    .arrUp {
        transform: rotate(-135deg);
        -webkit-transform: rotate(-135deg);
    }

    .arrDown {
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }

    .main_table thead tr th:hover{
        cursor: pointer;
    }
</style>

<body>
    <div class="container">
        <div class="title">
            <h2>預約總覽</h2>
        </div>

        <table class="main_table" id="myTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0);sortBtn(this);">
                        編號<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(1);sortBtn(this);">
                        預約人<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(2);sortBtn(this);">
                        地點<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(3);sortBtn(this);">
                        預約日期<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(4);sortBtn(this);">
                        預約時間<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(5);sortBtn(this);">
                        總人數<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(6);sortBtn(this);">
                        同行人數<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th></th>                               
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

<script>
    function sortTable(n) {
        var table, rows, switching, arror, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;

                // Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }

    function sortBtn(obj) {
        obj.querySelector("span[id='arror']").classList.toggle("arrDown");
    }
</script>