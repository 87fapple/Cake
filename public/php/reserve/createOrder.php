<?php session_start(); ?>
<?php
require_once('../DB.php');

$sid = $_REQUEST["location"];
$peopleNum = $_REQUEST["person"];
$fTime = $_REQUEST["timeOption"];
$fDate = $_REQUEST["selectedDate"];

// var_dump($_REQUEST);

if (!$sid || !$peopleNum || !$fTime || !$fDate) {
    echo "資料有空";
}

DB::select("call createOrder(1, ?, ?, ?, ?)", function ($rows) {
    foreach ($rows as $key => $row) {
        $result = $row["result"];

        if ($result === 'reserveProduct.php') {
            if(isset($row["orderToken"])){
                $oToken = $row["orderToken"];
                setcookie('oToken', $oToken, time() + 120, "/");
            }
        }
    }
    echo $result;
}, [$sid, $fTime, $fDate, $peopleNum]);
