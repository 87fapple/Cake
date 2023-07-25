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

    <style>
        input[type="radio"] {
            display: none;
        }

        /* 自定义样式来模拟按钮 */
        .radio-button-base,
        .radio-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #222222;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .radio-button {
            cursor: pointer;
        }

        /* 修改选中状态时的样式 */
        input[type="radio"][name='timeOption']:checked {
            background-color: #007BFF;
        }
    </style>

    <script>
        $(function() {
            const currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + 1);
            const nextDate = currentDate;

            $("#datepicker").datepicker({
                minDate: nextDate,
                dateFormat: 'yy-mm-dd',
            });
            $("#datepicker").on("change", function(e) {
                e.preventDefault();
                var optionsLocation = $("#location option:selected");
                var optionsPerson = $("#person option:selected");
                var optsLocalVal = optionsLocation.val();
                var optsPersonVal = optionsPerson.val();
                var fromdate = $(this).val();
                const selectedDay = $("#datepicker").datepicker("getDate");
                const formattedDate = $.datepicker.formatDate('yy-mm-dd', selectedDay);
                $("#selectedDate").val(formattedDate);

                fetch(`storeToTime.php?sid=${optsLocalVal}&fDate=${fromdate}&peopleNum=${optsPersonVal}`)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        console.log(data);
                        let viewTime = '';
                        data.forEach(function(e2) {
                            if (typeof(e2.sequel) !== 'undefined') {
                                viewTime += `
                                <label>
                                    <input type="radio" name="timeOption" value="${e2.sequel}">
                                    <span class="radio-button">${e2.sequel}</span>
                                </label>
                                 `
                            } else {
                                viewTime = `
                                    <button type="radio" value="${e2}">${e2}</button>
                                 `
                            }

                        })
                        document.getElementById("timezone").innerHTML = viewTime
                    })
                // alert(fromdate);
            });
        });

        window.onload = function(e) {
            e.preventDefault();
            fetch('store_sql.php')
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    // console.log(data);
                    let view = '<option style="display: none;">請選擇分店</option>';
                    data.forEach(function(e2) {
                        // console.log(e);
                        view += `
                            <option value="${e2.sid}">${e2.location}</option>
                        `
                    })
                    document.getElementById("location").innerHTML = view
                })

            document.getElementById("location").onchange = function(e) {
                var options = $("#location option:selected");
                var optsVal = options.val();

                fetch(`storeToCake_sql.php?sid=${optsVal}`)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        // console.log(data);
                        let view = '<option style="display: none;">請選擇產品</option>';
                        data.forEach(function(e2) {
                            // console.log(e);
                            view += `
                            <option value="${e2.cid}">${e2.cName}</option>
                        `
                        })
                        document.getElementById("cakeName").innerHTML = view
                    })
            }

            submitBTN.onclick = function(e) {
                fetch('createOrder.php', {
                        method: "POST",
                        body: new FormData(form)
                    })
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(data) {
                        console.log(data);
                    })

            }
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

    <h3>預約</h3>
    <div class="container">
        <!-- <form action="./reserveProduct.php" method="POST"> -->
        <form id="form">
            <label for="location">預約分店：</label>
            <select id="location" name="location">
            </select>

            <label for="person">預約人數</label>
            <select id="person" name="person">
                <option value="1">一位</option>
                <option value="2">兩位</option>
                <option value="3">三位</option>
                <option value="4">四位</option>
            </select>

            <label for="cakeName">選擇產品</label>
            <select id="cakeName" name="cakeName">
                <option>請先選擇店家</option>
            </select>
            <!-- <div id="addnewdiv">
                <label for="addCakeName">選擇產品</label>
                <select id="addCakeName" name="addCakeName">
                    <option value="皮卡蛋糕">皮卡蛋糕</option>
                    <option value="小火龍餅乾">小火龍餅乾</option>
                    <option value="廟挖馬卡龍">廟挖馬卡龍</option>
                </select>
            </div> -->
            <div>注意：產品數目少於人數時，將酌收陪同費120元/人。</div>
            <br><br>
            <div id="timeselect">
                <div id="datezone">
                    請選擇日期：
                    <br>
                    <br>
                    <div id="datepicker"></div>
                    <input type="hidden" id="selectedDate" name="selectedDate">
                </div>
                <div id="timeselectzone">請選擇時段：
                    <br>
                    <br>
                    <div id="timezone">
                        <span class="radio-button-base">請先選擇日期</span>
                    </div>
                </div>
                <br>

                <br>
                <input type="button" value="確認預約" id="submitBTN">
        </form>
    </div>
    <script>

    </script>



</body>

</html>