<?php session_start(); ?>
<?php
$token = isset($_COOKIE['token']) ? $_COOKIE['token'] : 'undefined';
if ($token !== 'undefined') {
    require('./php/DB.php');
}

$oInfo = [];
if (isset($_GET['oToken'])) {
    DB::select("select s.sid,s.location, o.people, o.reserveTime, o.reserveDate, o.oToken from orders o INNER JOIN store s on s.sid = o.sid where oToken = ?", function ($rows) use (&$oInfo) {
        if (count($rows) === 0) {
            header('Location: /Cake/public/error.php?error_code=1');
            die();
        } else {
            $oInfo[] = $rows[0];
        }
    }, [$_GET['oToken']]);
}
// var_dump($oInfo[0]);
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
    <link rel="stylesheet" href="../resources/css/reserve1.css">
    <link rel="stylesheet" href="../resources/css/footer2.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <script>
        $(function () {
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

                <?php if (isset($oInfo[0]["reserveDate"])) { ?>
                    const dateData = "<?= $oInfo[0]["reserveDate"] ?>";
                    const dataArray = dateData.split("-");
                    const year = parseInt(dataArray[0], 10);
                    const month = parseInt(dataArray[1], 10) - 1;
                    const day = parseInt(dataArray[2], 10);
                <?php } else { ?>
                    const year = null;
                    const month = null;
                    const day = null;
                <?php } ?>

                $("#datepicker").datepicker({
                    minDate: nextDate,
                    dateFormat: 'yy-mm-dd',
                    defaultDate: year !== null ? new Date(year, month, day) : null,
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

                    <?php if (isset($oInfo[0]["oToken"])) { ?>
                        fetch(`./php/reserve/storeToTime.php?sid=${optsLocalVal}&fDate=${fromdate}&peopleNum=${optsPersonVal}&checkedoToken=<?= $oInfo[0]["oToken"]; ?>`)
                    <?php } else { ?>
                        fetch(`./php/reserve/storeToTime.php?sid=${optsLocalVal}&fDate=${fromdate}&peopleNum=${optsPersonVal}`)
                    <?php } ?>
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
                                        <input type="radio" name="timeOption" value="${e2.sequel}"  style="background-color: #ffb12b; color: black;">
                                        <span class="radio-button" style="background-color: #ffb12b; color: black;">${e2.sequel}</span>
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
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        <?php if (isset($oInfo[0]["sid"]) && isset($oInfo[0]["location"])) { ?>
                                let view = `<option style="display: none;" value="<?= $oInfo[0]["sid"]; ?>"><?= $oInfo[0]["location"]; ?></option>`;
                        <?php } else { ?>
                                let view = '<option style="display: none;">請選擇分店</option>';
                        <?php } ?>
                            data.forEach(function (e2) {
                                view += `
                                <option value="${e2.sid}">${e2.location}</option>
                            `
                            })
                        document.getElementById("location").innerHTML = view
                    })

                submitBtn.onclick = function (e) {
                    if ($("#selectedDate").val() === "") {
                        const defaultDate = $("#datepicker").datepicker("option", "defaultDate");
                        $("#selectedDate").val($.datepicker.formatDate("yy-mm-dd", defaultDate));
                    }

                    fetch('./php/reserve/createOrder.php', {
                        method: "POST",
                        body: new FormData(ordersForm)
                    })
                        .then(function (response) {
                            return response.text();
                        })
                        .then(function (data) {
                            console.log(data);
                            if (data == "reserveProduct.php") {
                                <?php if (isset($oInfo[0]["oToken"])) { ?>
                                        location.href = data + '?checkedoToken=<?= $oInfo[0]["oToken"] ?>';
                                <?php } else { ?>
                                        location.href = data;
                                <?php } ?>
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
            <ul id="login_check" name="login_check"></ul>
        </div>
    </nav>

    <h3>預約</h3>
    <div class="container">
        <form id="ordersForm">
            <h2>預約</h2>
            <div id="checkLogin">請先
                <a href="./login.html">登入</a>
                後才能預約
            </div>

            <div class="scd-container">
                <label for="location">預約分店：</label>
                <select id="location" name="location"></select>

                <label for="person">預約人數</label>
                <select id="person" name="person">
                    <?php if (isset($oInfo[0]["people"])) { ?>
                        <option value="<?= $oInfo[0]["people"] ?>" style="display: none;"><?= $oInfo[0]["people"] ?>位
                        </option>
                    <?php } ?>
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
                            <?php if (isset($oInfo[0]["reserveTime"])) { ?>
                                <label>
                                    <input type="radio" name="timeOption" value="<?= $oInfo[0]["reserveTime"]; ?>"
                                        style="background-color: #ffb12b; color: black;" checked>
                                    <span class="radio-button" style="background-color: #ffb12b; color: black;">
                                        <?= $oInfo[0]["reserveTime"]; ?>
                                    </span>
                                </label>
                            <?php } else { ?>
                                <input type="hidden" name="timeOption">
                                <span class="radio-button-base">請先選擇日期</span>
                            <?php } ?>
                        </div>
                    </div>
                    <br>
                </div>
                <?php if (isset($oInfo[0]["oToken"])) { ?>
                    <input type="hidden" name="checkedoToken" value="<?= $oInfo[0]["oToken"]; ?>">
                <?php } ?>
                <br>
                <input type="button" value="確認預約" id="submitBtn" class="submitBtn">
                <span id="test"></span>
            </div>
        </form>
    </div>
    <!-- Footer -->
    <footer class="footer" style="margin-top: 144px;">
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
<script src="../resources/js/login.js"></script>
<script src="../resources/js/topBtn.js"></script>
<script src="../resources/js/navbar.js"></script>

</html>