<?php session_start(); ?>
<?php
// if (!$_COOKIE['token']) {
//     header('Location: /Cake/public/login.html');
//     die();
// }

require_once('../php/DB.php');
$sid = $_POST["location"] ?? null;
$peopleNum = $_POST["person"] ?? null;
$fTime = $_POST["timeOption"] ?? null;
$fDate = $_POST["selectedDate"] ?? null;
$checkedoToken = $_POST["checkedoToken"] ?? "0";
$userId = $_POST['userId'];

// var_dump($_REQUEST);

if (!$sid || !$peopleNum || !$fTime || !$fDate || !$userId) {
    echo "資料有空";
    die();
}

DB::select("call createOrder2(?, ?, ?, ?, ?, ?)", function ($rows) {
    foreach ($rows as $key => $row) {
        $result = $row["result"];

        if ($result === 'change_reserveProduct.php') {
            if(isset($row["orderToken"])){
                $oToken = $row["orderToken"];
                setcookie('oToken', $oToken, time() + 12000, "/");
            }
        }
    }
    echo $result;
}, [$userId, $sid, $fTime, $fDate, $peopleNum, $checkedoToken]);
