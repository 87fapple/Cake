<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require_once('../DB.php');
// var_dump($_REQUEST);

$oid = $_REQUEST["oid"];
$makeNum = $_REQUEST["makeNum"];
$companion = $_REQUEST["companion"];
$nameArr = [$_REQUEST["cakeName"]];
$numArr = [$_REQUEST["num"]];
$checkNum = 0; 

for ($x = 0; $x < $makeNum; $x++) {
    $nameKey = "newCakeName" . ($x + 1);
    if (isset($_REQUEST[$nameKey]) && trim($_REQUEST[$nameKey]) !== "") {
        $nameArr[] = $_REQUEST[$nameKey];
    }

    $numKey = "newNum" . ($x + 1);
    if (isset($_REQUEST[$numKey]) && trim($_REQUEST[$numKey]) !== "") {
        $numArr[] = $_REQUEST[$numKey];
    }
}

for ($y = 0; $y<count($numArr);$y++){
    $checkNum += $numArr[$y];
}

if (count($nameArr) !== count($numArr)){
    echo("品項數量核對有誤!!");
    die();
} elseif ($checkNum > $makeNum){
    echo("選取品項總份數超過製作份數!!");
    die();
}

var_dump($nameArr);
var_dump($numArr);

// DB::update("update orders set companion = ? where oid = ?",[$companion, $oid]);

// for($y = 0; $y < count($nameArr) ; $y++){
//     DB::insert("insert into orderlist value (?, ?, ?)",[$oid, $nameArr[$y], $numArr[$y]]);
// }

echo "OK";
