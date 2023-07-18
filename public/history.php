<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require('php/db2.php');
$token = $_COOKIE['token'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Cake/resources/css/nav_input_css.css">
    <link rel="stylesheet" href="/Cake/resources/css/history.css">
</head>

<body>

    <body>
        <div class="topnav">
            <a href="#logout">登出</a>
            <a href="Q&A.html">常見問題</a>
            <a href="Detail.html">商品介紹</a>
            <a href="reserve.html">預約課程</a>
            <a href="locations.html">分店資訊</a>
        </div>

        <div name="selectarea" id="sel">
            <div href="#changeData" class="selectarea">更改會員資料</div>
            <div href="#reserveHistory" class="selectarea">預約紀錄</div>
            <p id="hiuser"> 您好，<span>使用者</span></p>
        </div>


        <div id="">
            <div id="">
                <h1>預約紀錄</h1>
            </div>

            <table>
                <tr>
                    <th>日期</th>
                    <th>分店</th>
                    <th>時段</th>
                    <th>產品</th>
                    <th>總人數</th>
                    <th>是否取消</th>
                </tr>

                <tr>
                    <td>2023/7/6</td>
                    <td>皮卡丘店</td>
                    <td>13:00-15:00</td>
                    <td id="products">小火龍餅乾X2、皮卡丘蛋糕X1</td>
                    <td>3人</td>
                    <td id="button"><button>取消預約</button></td>
                </tr>

                <tr>
                    <td>2023/7/6</td>
                    <td>皮卡丘店</td>
                    <td>13:00-15:00</td>
                    <td id="products">小火龍餅乾</td>
                    <td>1人</td>
                    <td>已取消</td>
                </tr>
            </table>
    </body>

</html>