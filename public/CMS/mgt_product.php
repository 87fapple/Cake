<?php $title = 'CMS Reserve Management'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '預約總覽'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    .order-table {
        border-collapse: collapse;
        margin: 12px 5% 80px;
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

    .order-table tbody tr td a {
        background-color: #ffa237;
        border: 1px solid #ffa237;
        border-radius: 6px;
        text-decoration: none;
        color: #111;
        padding: 4px 12px;
    }

    .order-table tbody tr td a:hover {
        background-color: #ffcb53;
        border: 1px solid #ffcb53;
        cursor: pointer;
    }

    .order-table tbody tr td a:last-child {
        margin-left: 16px;
    }
</style>

<?php
require('../php/db2.php');

$sql = "select * from cake";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<body>
    <div class="container">
        <div class="title">
            <h2 style="">
                <center />產品總覽
            </h2>
            <a href="add_product.php">新增品項</a>
        </div>
        <table class="order-table">
            <thead>
                <tr>
                    <th />編號
                    <th />品名
                    <th />種類
                    <th />價格
                    <th />尺寸
                    <th />難度
                    <th />
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
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
                            <a onclick="delet(' . $row['cid'] . ')">刪除</a>
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
            title: '注意',
            content: '確定要刪除嗎',
            btn: ['確定', '取消'],
            yes: function(index, layero) {
                //按钮【按钮一】的回调
                location.replace("../php/admin/delete.php?cid=" + cid);
            }
        });
    }
</script>