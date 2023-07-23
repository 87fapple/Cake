<?php
require_once('../BDB.php');

$sid = $_REQUEST["sid"];
$peopleNum = $_REQUEST["peopleNum"];
$fDate = $_REQUEST["fDate"];

$daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

$dayColumn = $daysOfWeek[date('N', strtotime($fDate)) - 1];

DB::select("select $dayColumn from storeToTime where sid = ?", function ($rows) {
    checkTime($rows);
}, [$sid]);

function checkTime($datas)
{
    $cTime = [];

    foreach ($datas as $data => $values) {
        foreach ($values as $key => $value) {
            if ($value === "No availability") {
                $cTime[] = "No availability";
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
