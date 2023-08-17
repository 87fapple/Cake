<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require_once('../DB.php');

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

$checkVal = [];
$storeName = "";
DB::select("select stc.cid, s.location from store s join orders o on o.sid = s.sid left join storetocake stc on stc.sid = s.sid where o.oid = ?", function ($rows) use (&$checkVal, &$storeName) {
    // var_dump($rows);
    $checkVal[] = $rows;
    $storeName = $rows[0]['location'];
}, [$oid]);

$checkInfo = [];
foreach ($checkVal[0] as $checkKey => $checkVal) {
    $checkInfo[] = $checkVal["cid"];
}

$cakeInfo = [];
DB::select("select cid, cName from cake", function ($rows) use (&$cakeInfo) {
    $cakeInfo[] = $rows;
});

$getCKInfo = [];
foreach ($cakeInfo[0] as $ckInfoKey => $ckInfoVal) {
    $getCKInfo[$ckInfoVal["cid"]] = $ckInfoVal["cName"];
}

$notfound = [];
foreach ($nameNumArr as $key => $value) {
    if (!in_array($key, $checkInfo)) {
        $notfound[] = $getCKInfo[$key];
    }
}

if(!empty($notfound)){
    $notfoundArray = implode('、', $notfound);
    echo "<span style='color:blue;'>{$storeName}</span>不支持<span style='color:red;'>{$notfoundArray}</span>品項，請重新選擇其他支持品項，謝謝!";
    die();
}

if ($checkNum > $makeNum) {
    echo ("選取品項總份數超過製作份數!!");
    die();
} elseif ($checkNum < $makeNum) {
    $sceneNum = $makeNum - $checkNum;
    if (isset($nameNumArr[0])) {
        $nameNumArr[0] += $sceneNum;
    } else {
        $nameNumArr[0] = $sceneNum;
    }
}

DB::update("update orders set companion = ? where oid = ?", [$companion, $oid]);

if ($checkedoToken !== "0") {
    DB::delete("delete from orderlist where oid = ?", [$oid]);
}

foreach ($nameNumArr as $key => $value) {
    DB::insert("insert into orderlist value (?, ?, ?)", [$oid, $key, $value]);
}

echo "reserveTotal.php";