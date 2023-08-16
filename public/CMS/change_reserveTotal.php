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

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <!-- <link rel="stylesheet" href="jqueryui/style.css"> -->

    <!-- <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="stylesheet" href="../resources/css/reserve1.css">
    <link rel="stylesheet" href="../resources/css/reserve2.css">
    <link rel="stylesheet" href="../resources/css/footer2.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css"> -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<style>
    .column-container {
        display: flex;
    }

    .column {
        flex: 1;
        margin-right: 20px;
        /* 調整列之間的間距 */
    }
</style>

<script>
</script>

<body>
    <h3>訂單資訊</h3>
    <div class="container">
        <h2>訂單已成立</h2>
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
            <p Align="Center">回到<a href="mgt_reserve.php">預約管理</a>修改</p>
        </div>
    </div>




</body>
</html>