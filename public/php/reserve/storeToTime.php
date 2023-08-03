<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require('../DB.php');

$sid = $_REQUEST["sid"];
$peopleNum = $_REQUEST["peopleNum"];
$fDate = $_REQUEST["fDate"];

$daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

$dayColumn = $daysOfWeek[date('N', strtotime($fDate)) - 1];

DB::select("select $dayColumn from storetotime where sid = ?", function ($rows) {
    checkTime($rows);
}, [$sid]);

function checkTime($datas)
{
    $cTime = [];

    foreach ($datas as $data => $values) {
        foreach ($values as $key => $value) {
            if ($value === "No availability") {
                $cTime[] = "本日公休";
            } else {
                DB::select('CALL getTime(?, ?, ?, ?)', function ($rows) use (&$cTime) {
                    if ($rows[0]['sequel'] !== "fail") {
                        $cTime[] = $rows[0];
                    }
                }, [$GLOBALS["sid"], $value, $GLOBALS["peopleNum"], $GLOBALS["fDate"]]);
            }
        }
    }

    if (!empty($cTime)) {
        echo (json_encode($cTime, JSON_UNESCAPED_UNICODE));
    }else{
        echo "資料有誤";
    }
}
