<?php
require('../DB.php');
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<<<<<<< HEAD
    
    <link rel="stylesheet" href="../../../resources/css/Navbar.css">
=======

    <link rel="stylesheet" href="../../../resources/css/navbar.css">
>>>>>>> 25c8023f2e8be78d588e408f65608bfc0528e4cd
    <link rel="stylesheet" href="../../../resources/css/reserve.css">
    <link rel="stylesheet" href="../../../resources/css/footer2.css">

    <style>
        input[type="radio"] {
            display: none;
        }

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

        input[type="radio"]:checked+span {
            background-color: #007BFF;
        }
    </style>

    <script>
        $(function () {
            const currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + 1);
            const nextDate = currentDate;

            $("#datepicker").datepicker({
                minDate: nextDate,
                dateFormat: 'yy-mm-dd',
            });
            $("#datepicker").on("change", function (e) {
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
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        console.log(data);
                        let viewTime = '';
                        data.forEach(function (e2) {
                            if (typeof (e2.sequel) !== 'undefined') {
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

        window.onload = function (e) {
            e.preventDefault();
            fetch('store_sql.php')
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    // console.log(data);
                    let view = '<option style="display: none;">請選擇分店</option>';
                    data.forEach(function (e2) {
                        // console.log(e);
                        view += `
                            <option value="${e2.sid}">${e2.location}</option>
                        `
                    })
                    document.getElementById("location").innerHTML = view
                })

            submitBtn.onclick = function (e) {
                fetch('createOrder.php', {
                    method: "POST",
                    body: new FormData(ordersForm)
                })
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (data) {
                        console.log(data);
                        if (data == "reserveProduct.php") {
                            location.href = data;
                        } else {
                            let view = '';
                            view += `
                                <div>${data}</div>
                            `;
                            document.getElementById("test").innerHTML = view
                        }
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
        <form id="ordersForm">
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
                        <input type="hidden" name="timeOption">
                        <span class="radio-button-base">請先選擇日期</span>
                    </div>
                </div>
                <br>

                <br>
                <input type="button" value="確認預約" id="submitBtn">
                <span id="test"></span>
        </form>
    </div>
    <script>

    </script>



</body>

</html>