<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}

require_once('../DB.php');
$sid = $_REQUEST["location"] ?? null;
$peopleNum = $_REQUEST["person"] ?? null;
$fTime = $_REQUEST["timeOption"] ?? null;
$fDate = $_REQUEST["selectedDate"] ?? null;
$token = $_COOKIE['token'];

// var_dump($_REQUEST);

if (!$sid || !$peopleNum || !$fTime || !$fDate) {
    echo "資料有空";
    die();
}

DB::select("call createOrder(?, ?, ?, ?, ?)", function ($rows) {
    foreach ($rows as $key => $row) {
        $result = $row["result"];

        if ($result === 'reserveProduct.php') {
            if(isset($row["orderToken"])){
                $oToken = $row["orderToken"];
                setcookie('oToken', $oToken, time() + 12000, "/");
            }
        }
    }
    echo $result;
}, [$token, $sid, $fTime, $fDate, $peopleNum]);
