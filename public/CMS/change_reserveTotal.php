<?php $title = 'CMS Modify Product'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '修改訂單'; ?>
<?php include_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>

<?php session_start(); ?>
<?php

// session_destroy();
setcookie('oToken', '',time() -1, "/");

// if (!$_COOKIE["oToken"]) {
//     header('Location: /Cake/public/history.php');
//     die();
// }
require('../php/DB.php');

$oInfo = [];
$oListInfo = [];

if (isset($_COOKIE["oToken"])) {
    $oToken = $_COOKIE["oToken"];
}

DB::select("select u.uName, s.location, o.people, (o.people - o.companion) as makenum, o.companion from orders o INNER JOIN userinfo u ON u.uid = o.uid INNER JOIN store s on s.sid = o.sid where oToken = ?", function ($rows) use (&$oInfo) {
    $oInfo[] = $rows[0];
}, [$oToken]);

DB::select(
    "select GROUP_CONCAT(c.cName,'*',ol.num) as orderItem from orderlist ol 
        inner join orders o 
            on o.oid = ol.oid 
        inner join cake c 
	        on c.cid = ol.cid 
        where o.oToken = ?"
    ,
    function ($rows) use (&$oListInfo) {
        $oListInfo[] = $rows[0];
    },
    [$oToken]
);
var_dump($oInfo);
var_dump($oListInfo);
?>

<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<!-- <link rel="stylesheet" href="jqueryui/style.css"> -->

<link rel="stylesheet" href="./CMS_css/mgt_reserve.css">

<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<style>
    .container {
        width: calc(100% - 200px);
        position: relative;
        top: 52px;
        left: 200px;
    }

    .box {
        background-color: #fff5d6c4;
        width: calc(95% - 200px);
        margin: 32px 2.5% 72px;
        border: 2px solid #885500;
        border-radius: 12px;
    }

    .box h2,
    .box h3 {
        margin: 32px;
    }

    .column-container {
        display: flex;
    }

    .column {
        flex: 1;
        margin-right: 20px;
        /* 調整列之間的間距 */
    }

    .scd-container p a {
        display: inline-block;
        padding: 10px 20px;
        width: 70%;
        color: #000000;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin: 10px 6rem;
        background-color: #ffb12b;
        font-weight: bold;
        font-size: larger;
        text-decoration: none;
    }

    .scd-container p a:hover {
        background-color: #ffd52b;
    }
</style>

<body>
    <div class="container box">
        <h2>訂單已修改完成</h2>
        <div class="scd-container">
            <p>訂單資訊</p>
            <hr>
            <label for="name"><b>訂購人姓名：</b></label>
            <br>
            <input type="text" value="<?= $oInfo[0]["uName"] ?>" name="name" readonly="readonly" class="modal1">
            <br>
            <label for="location"><b>分店：</b></label>
            <br>
            <input type="text" value="<?= $oInfo[0]["location"] ?>" name="location" readonly="readonly" class="modal1">
            <br>
            <div class="column-container">
                <div class="column">
                    <label for="people"><b>總人數：</b></label>
                    <input type="text" value="<?= $oInfo[0]["people"] ?>" name="people" readonly="readonly"
                        class="modal1">
                </div>
                <div class="column">
                    <label for="people1"><b>製作份數：</b></label>
                    <input type="text" value="<?= $oInfo[0]["makenum"] ?>" name="people1" readonly="readonly"
                        class="modal1">
                </div>
                <div class="column">
                    <label for="people2"><b>陪同人數：</b></label>
                    <input type="text" value="<?= $oInfo[0]["companion"] ?>" name="people2" readonly="readonly"
                        class="modal1">
                </div>
            </div>

            <label for="cakeName"><b>預約產品：</b></label>
            <br>
            <textarea name="cakeName" readonly="readonly"><?= $oListInfo[0]["orderItem"] ?></textarea>
            <br>
            <p Align="Center"><a href="mgt_reserve.php">回到管理頁面</a></p>
        </div>
    </div>
</body>
</html>