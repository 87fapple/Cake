<?php $title = 'CMS Reserve Management'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '預約總覽'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .container {
        width: calc(100% - 200px);
        overflow: auto;
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

    .container .title a {
        display: block;
        width: 100px;
        height: 24px;
        padding: 12px 8px;
        border: 1px solid #ffa237;
        border-radius: 8px;
        background-color: #ffa237;
        color: #000;
        font-size: 20px;
        text-align: center;
        text-decoration: none;
    }

    .container a:hover {
        background-color: #ffcb53;
        border: 1px solid #ffcb53;
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
        background-color: #ffa237;
        border: 1px solid #ffa237;
        border-radius: 6px;
        text-decoration: none;
        color: #111;
        padding: 4px 12px;
    }

    .main_table tbody tr td a:hover {
        background-color: #ffcb53;
        border: 1px solid #ffcb53;
        cursor: pointer;
    }

    .main_table tbody tr td a:last-child {
        margin-left: 8px;
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

    .main_table thead tr th:hover {
        cursor: pointer;
    }
</style>

<?php
require('../php/db2.php');

$sql = "select * from cake where not cName='現場選擇品項'";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<body>
    <div class="container">
        <div class="title">
            <h2>產品總覽</h2>
            <a href="add_product.php">新增品項</a>
        </div>
        <table class="main_table" id="myTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0);sortBtn(this);">
                        編號<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(1);sortBtn(this);">
                        品名<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(2);sortBtn(this);">
                        價格<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(3);sortBtn(this);">
                        種類<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(4);sortBtn(this);">
                        尺吋<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th onclick="sortTable(5);sortBtn(this);">
                        難度<span id="arror" class="arrow arrUp"></span>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    if ($row['remove'] == 0) {
                        $remove = '<a onclick="remove(' . $row['cid'] . ',' . $row['remove'] . ')">上架中</a>';
                    } else {
                        $remove = '<a style="background-color: #b3b3b3;" onclick="remove(' . $row['cid'] . ',' . $row['remove'] . ')">下架中</a>';
                    }
                    echo
                    '<tr>
                    <td />' . $row['cid'] .
                        '<td />' . $row['cName'] .
                        '<td />' . $row['price'] .
                        '<td />' . $row['kind'] .
                        '<td />' . $row['cSize'] .
                        '<td />' . $row['level'] .
                        '<td align="right" width="100px" />
                            <a href="change_product.php?cid=' . $row['cid'] . '" )">修改</a>
                            ' . $remove . '
                            <a style="background-color:red;color:white" 
                            onclick="delet(' . $row['cid'] . ')">刪除</a>
                            </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

<script src="//unpkg.com/layui@2.7.6/dist/layui.js"></script>
<script>
    function delet(cid) {
        this.cid = cid;
        layer.open({
            title: '警告',
            content: '刪除後資料就無法復原',
            btn: ['確定', '取消'],
            yes: function(index) {
                layer.open({
                    title: '這是最後一次警告',
                    content: '確定要刪除嗎?',
                    btn: ['確定', '取消'],
                    yes: function(index) {
                        //按钮【按钮一】的回调
                        location.replace("../php/admin/delete.php?cid=" + cid);
                    }
                });
            }
        });
    }

    function remove(cid, remove) {
        this.cid = cid;
        this.remove = remove;
        location.replace("remove.php?cid=" + cid + "&remove=" + remove);
    }

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