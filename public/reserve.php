<?php session_start(); ?>
<?php
$token = isset($_COOKIE['token']) ? $_COOKIE['token'] : 'undefined';
if ($token !== 'undefined') {
    require('./php/DB.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <!-- <link rel="stylesheet" href="jqueryui/style.css"> -->

    <link rel="stylesheet" href="../resources/css/Navbar.css">
    <link rel="stylesheet" href="../resources/css/reserve.css">
    <link rel="stylesheet" href="../resources/css/footer2.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

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
        $(function() {
            const token = "<?= $token; ?>";

            if (token === 'undefined') {
                $("#checkLogin").show();
                $(".scd-container").hide();
            } else {

                $("#checkLogin").hide();
                $(".scd-container").show();
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

                    fetch(`./php/reserve/storeToTime.php?sid=${optsLocalVal}&fDate=${fromdate}&peopleNum=${optsPersonVal}`)
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
                                        <input type="radio" value="" disabled>${e2}</input>
                                     `
                                }

                            })
                            document.getElementById("timezone").innerHTML = viewTime
                        })
                });

                fetch('./php/reserve/store_sql.php')
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        let view = '<option style="display: none;">請選擇分店</option>';
                        data.forEach(function(e2) {
                            view += `
                                <option value="${e2.sid}">${e2.location}</option>
                            `
                        })
                        document.getElementById("location").innerHTML = view
                    })

                submitBtn.onclick = function(e) {
                    fetch('./php/reserve/createOrder.php', {
                            method: "POST",
                            body: new FormData(ordersForm)
                        })
                        .then(function(response) {
                            return response.text();
                        })
                        .then(function(data) {
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
        });
    </script>

</head>

<body>
    <!-- Back-to-Top Button -->
    <button onclick="topFunction()" class="topBtn" id="topBtn"></button>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbarTitle">
            <a href="../public/mainpage.html">
                <img src="../image/icon-noBorder-whiteFont.png">
            </a>
        </div>
        <div class="hambuger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="navbarLink">
            <ul>
                <li><a href="../public/menu.php">產品介紹</a></li>
                <li><a href="../public/locations.html">分店資訊</a></li>
                <li><a href="../public/reserve.php">預約課程</a></li>
                <li><a href="../public/Q&A.html">常見問題</a></li>
                <li><a href="../public/login.html">登入會員</a></li>
            </ul>
        </div>
    </nav>

    <h3>預約</h3>
    <div class="container">
        <form id="ordersForm">
            <h2>預約</h2>
            <div id="checkLogin">請先
                <a href="./login.html">登入</a>
            後才能預約</div>

            <div class="scd-container">
                <label for="location">預約分店：</label>
                <select id="location" name="location"></select>

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
                </div>
                <br>
                <input type="button" value="確認預約" id="submitBtn">
                <span id="test"></span>
            </div>
        </form>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="footerContainer">
            <div class="footerRow">
                <div class="footerCol">
                    <h4>DIY蛋糕</h4>
                    <ul>
                        <li><a href="">關於我們</a></li>
                        <li><a href="">常見問題</a></li>
                    </ul>
                </div>
                <div class="footerCol">
                    <h4>服務內容</h4>
                    <ul>
                        <li><a href="">立即預約</a></li>
                        <li><a href="">產品介紹</a></li>
                    </ul>
                </div>
                <div class="footerCol">
                    <h4>聯絡我們</h4>
                    <div class="socialLinks">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
<script src="../resources/js/topBtn.js"></script>

</html>