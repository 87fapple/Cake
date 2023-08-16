<?php session_start(); ?>
<?php
require_once('../php/DB.php');

$oid = $_REQUEST["oid"] ?? null;
$makeNum = $_REQUEST["makeNum"] ?? null;
$companion = $_REQUEST["companion"] ?? null;
$nameArr = [$_REQUEST["cakeName"]];
$numArr = [$_REQUEST["num"]];
$checkedoToken = $_REQUEST["checkedoToken"] ?? "0";
$sceneNum = 0;

if (!$oid || !$makeNum || !$nameArr || !$numArr) {
    echo "資料有空";
    die();
}

$nameNumArr = [
    $_REQUEST["cakeName"] => $_REQUEST["num"]
];

$checkNum = $_REQUEST["num"];

for ($x = 0; $x < $makeNum; $x++) {
    $nameKey = "newCakeName" . ($x + 1);
    if (isset($_REQUEST[$nameKey]) && trim($_REQUEST[$nameKey]) !== "") {
        $name = $_REQUEST[$nameKey];
        $num = isset($_REQUEST["newNum" . ($x + 1)]) ? $_REQUEST["newNum" . ($x + 1)] : 0;

        if (array_key_exists($name, $nameNumArr)) {
            $nameNumArr[$name] += $num;
        } else {
            $nameNumArr[$name] = $num;
        }
        $checkNum += $num;
    }
}

if ($checkNum > $makeNum) {
    echo ("選取品項總份數超過製作份數!!");
    die();
} elseif ($checkNum < $makeNum) {
    $sceneNum = $makeNum - $checkNum;
    $nameNumArr[0] = $sceneNum;
}

DB::update("update orders set companion = ? where oid = ?", [$companion, $oid]);

if ($checkedoToken !== "0") {
    DB::delete("delete from orderlist where oid = ?", [$oid]);
}

foreach ($nameNumArr as $key => $value) {
    DB::insert("insert into orderlist value (?, ?, ?)", [$oid, $key, $value]);
}

echo "change_reserveTotal.php";