<?php session_start(); ?>
<?php
require_once('../DB.php');

if (isset($_COOKIE["oToken"])) {
    $oToken = $_COOKIE["oToken"];
}

$cInfo = [];

DB::select("select * from orders where oToken = 'b2729291-2f66-11ee-b7cc-0242ac110004'", function ($rows) use (&$cInfo) {
    $cInfo[] = $rows[0];
});

var_dump($cInfo[0]);
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- <link rel="stylesheet" href="../resources/css/預約表單.css"> -->
    <!-- <link rel="stylesheet" href="jqueryui/style.css"> -->
    <!-- <link rel="stylesheet" href="../resources/css/nav_input_css.css"> -->
    <script>
        $(function () {
            fetch(`storeToCake_sql.php?indexInfo=<?= $cInfo[0]["sid"] ?>`,)
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    console.log(data);
                    let view = '<option style="display: none;">請選擇產品</option>';
                    data.forEach(function (e2) {
                        view += `
                            <option value="${e2.cid}">${e2.cName}</option>
                        `
                    })
                    document.getElementById("cakeName").innerHTML = view
                })
        });

        window.onload = function (e) {
            e.preventDefault();
            // fetch(`storeToCake_sql.php`)
            //     .then(function (response) {
            //         return response.json();
            //     })
            //     .then(function (data) {
            //         // console.log(data);
            //         let view = '';
            //         data.forEach(function (e2) {
            //             // console.log(e);
            //             view += `
            //                 <option value="${e2.cid}">${e2.cName}</option>
            //             `
            //         })
            //         document.getElementById("cakeName").innerHTML = view
            //     })
        }
    </script>
</head>

<body>
    <div class="topnav">
        <a href="#logout">登入/註冊</a>
        <a href="#contact">常見問題</a>
        <a href="#news">商品介紹</a>
        <a href="#reserve">預約課程</a>
        <a href="#location">分店資訊</a>
    </div>

    <h3>預約產品</h3>
    <div class="container">
        <form action="/action_page.php">
            <div>目前預定人數
                <input type="text" value="<?= $cInfo[0]["people"] ?>">
                <label for="makeNum">製作份數</label>
                <select id="makeNum" name="makeNum">
                    <option style="display: none;">請選擇製作份數</option>
                    <option >一份</option>
                    <option >兩份</option>
                </select>
                <span>陪同人數:</span><input type="text" disabled value="2">
            </div>
            <div>
                <label for="cakeName">選擇產品</label>
                <select id="cakeName" name="cakeName">
                </select>
                <label for="num">份數</label>
                <select id="num" name="num">
                    <option value="1">一位</option>
                    <option value="2">兩位</option>
                    <option value="3">三位</option>
                    <option value="4">四位</option>
                </select>
            </div>

            <div>注意：產品數目少於人數時，將酌收陪同費120元/人。</div>
            <button id="addnewdiv">新增品項</button>
            <!-- <div id="newdiv">
                <label for="newCakeName">選擇產品</label>
                <select id="newCakeName" name="newCakeName">
                    <option value="皮卡蛋糕">皮卡蛋糕</option>
                </select>
                <label for="num">份數</label>
                <select id="num" name="num">
                    <option value="1">一位</option>
                    <option value="2">兩位</option>
                </select>
            </div> -->
            <br>

            <br>
            <input type="button" value="確認產品" id="submitBTN">
        </form>
    </div>
    <script>

    </script>



</body>

</html>