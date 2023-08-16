<?php session_start(); ?>
<?php $title = 'CMS Home Management'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '首頁管理'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>

<?php
// if (!$_COOKIE['token']) {
//     header('Location: /Cake/public/login.html');
//     die();
// }


require('../php/db2.php');

$sql = "select * from userinfo where not uName = '管理員'";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://kit.fontawesome.com/6c4c2bf9f6.js" crossorigin="anonymous"></script>

<script>
    $(function() {
        $("#datepicker").datepicker();
    });
</script>

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
</style>

<body>
    <div class="container">
        <div class="title">
            <h2>會員總覽</h2>
        </div>
        <table class="main_table">
            <thead>
                <tr >
                    <th />編號
                    <th />名稱
                    <th />信箱
                    <th />電話
                    <th />
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $result->fetch_assoc()) {
                        echo
                        '<tr">
                        <td>' . $row['uid'] . '</td>
                        <td>' . $row['uName'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['phone'] . '</td>
                        <td align="right"><a>修改資料</a></td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
