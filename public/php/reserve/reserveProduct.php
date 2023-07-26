<?php
require('../BDB.php');


?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- <link rel="stylesheet" href="../resources/css/預約表單.css"> -->
    <!-- <link rel="stylesheet" href="jqueryui/style.css"> -->
    <!-- <link rel="stylesheet" href="../resources/css/nav_input_css.css"> -->

    <script>
        $(function() {

        });

        window.onload = function(e) {
            e.preventDefault();
            fetch(`storeToCake_sql.php`)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    // console.log(data);
                    let view = '';
                    data.forEach(function(e2) {
                        // console.log(e);
                        view += `
                            <option value="${e2.cid}">${e2.cName}</option>
                        `
                    })
                    document.getElementById("cakeName").innerHTML = view
                })
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
            <div>目前預定人數</div>
            <label for="cakeName">選擇產品</label>
            <select id="cakeName" name="cakeName">
                <option style="display: none;">請選擇產品</option>
            </select>
            <div>注意：產品數目少於人數時，將酌收陪同費120元/人。</div>
            <button id="addnewdiv">新增品項</button>
            <div id="newdiv">
                <label for="newCakeName">選擇產品</label>
                <select id="newCakeName" name="newCakeName">
                    <option value="皮卡蛋糕">皮卡蛋糕</option>
                    <option value="小火龍餅乾">小火龍餅乾</option>
                    <option value="廟挖馬卡龍">廟挖馬卡龍</option>
                </select>
            </div>
            <br>

            <br>
            <input type="submit" value="確認產品" id="submitBTN">
        </form>
    </div>
    <script>

    </script>



</body>

</html>