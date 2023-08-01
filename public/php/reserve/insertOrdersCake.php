<?php session_start(); ?>
<?php
require_once('../DB.php');
// var_dump($_REQUEST);

$oid = $_REQUEST["oid"];
$makeNum = $_REQUEST["makeNum"];
$companion = $_REQUEST["companion"];
$nameArr = [$_REQUEST["cakeName"]];
$numArr = [$_REQUEST["num"]];

for ($x = 0; $x < $makeNum; $x++) {
    $nameKey = "newCakeName" . ($x + 1);
    if (isset($_REQUEST[$nameKey])) {
        $nameArr[] = $_REQUEST[$nameKey];
    }

    $numKey = "newNum" . ($x + 1);
    if (isset($_REQUEST[$numKey])) {
        $numArr[] = $_REQUEST[$numKey];
    }
}

// var_dump($nameArr);
// var_dump($numArr);

for($y = 0; $y < count($nameArr) ; $y++){
    DB::insert("insert into orderlist value (?, ?, ?)",[$oid, $nameArr[$y], $numArr[$y]]);
}

echo "OK";
