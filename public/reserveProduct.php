<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require('./php/DB.php');

$token = $_COOKIE['token'];
$cInfo = [];

if (isset($_COOKIE["oToken"])) {
    $oToken = $_COOKIE["oToken"];
}
// $oToken = 'b2729291-2f66-11ee-b7cc-0242ac110004';

DB::select("select * from orders where oToken = ?", function ($rows) use (&$cInfo) {
    $cInfo[] = $rows[0];
}, [$oToken]);
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

    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="stylesheet" href="../resources/css/reserve.css">
    <link rel="stylesheet" href="../resources/css/footer.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <script>
        $(function () {
            const cInfoSid = <?= $cInfo[0]["sid"] ?>;
            $("#hidden").hide();
            let data;
            let nameFilled = false;
            let numFilled = false;
            let currentDivIndex = 0;

            const nextNumber = (function () {
                var lastNumber = 0;
                return function () {
                    lastNumber += 1;
                    return lastNumber;
                };
            })();

            var people = $("#people").val();
            let view1 = '<option style="display: none;">請選擇製作份數</option>';
            var numList = [];
            for (var i = Math.round(people / 2); i <= people; i++) {
                view1 += `
                            <option value=${i}>${i}份</option>
                        `;
            }
            document.getElementById("makeNum").innerHTML = view1

            $("#makeNum").on('change', function (e) {
                var mNum = $("#makeNum option:selected").val();
                var people = $("#people").val();
                let view4 = '';
                numFilled = false;
                currentDivIndex = -1;
                nextNewNumber();
                $("#addnewdiv").show();

                // console.log(mNum);
                for (let i = 0; i < mNum; i++) {
                    universalNums(i);
                }

                for (let a = 1; a < mNum; a++) {
                    view4 += `
                    <div id="newdiv${a}" style="display:none">
                        <label for="newCakeName${a}">選擇產品</label>
                            <select id="newCakeName${a}" name="newCakeName${a}">
                            <option style="display: none;" value="">請選擇產品</option>
                                <optgroup label="蛋糕" id="newCake${a}">
                                <optgroup label="餅乾" id="newCookie${a}">
                                <optgroup label="點心" id="newDessert${a}">
                            </select>
                        <label for="newNum${a}">份數</label>
                            <select id="newNum${a}" name="newNum${a}"></select>
                        <input type="button" id="hideNewDiv${a}" value="移除" onClick="hideNewDivs(${a})"/>
                    </div>
                    `;
                }
                $("#newChoose").html(view4);

                $("#companion").val(people - mNum);
                $("#hidden").show();
            })

            fetch(`./php/reserve/storeToCake_sql.php?indexInfo=${cInfoSid}`)
                .then(function (response) {
                    return response.json();
                })
                .then(function (responseData) {
                    data = responseData;
                    universalOptions();
                })

            document.getElementById("addnewdiv").onclick = function (e) {
                nextNewNumber();
            }

            function nextNewNumber() {
                var mNum = $("#makeNum option:selected").val();

                const newDivs = $("[id^='newdiv']");

                if (currentDivIndex <= mNum) {
                    $(newDivs[currentDivIndex]).show();
                    currentDivIndex += 1;
                    universalOptions();
                    universalNums();

                    if (currentDivIndex == (mNum - 1)) {
                        $("#addnewdiv").hide();
                    }
                }
            }

            function universalOptions() {
                var mNum = $("#makeNum option:selected").val();

                let cakeView = '';
                let cookieView = '';
                let dessertView = '';

                data.forEach(function (e) {
                    switch (e.kind) {
                        case '蛋糕':
                            cakeView += `
                                <option value="${e.cid}">${e.cName}</option>
                            `;
                            break;
                        case '餅乾':
                            cookieView += `
                                <option value="${e.cid}">${e.cName}</option>
                            `;
                            break;
                        case '點心':
                            dessertView += `
                                <option value="${e.cid}">${e.cName}</option>
                            `;
                            break;
                    }
                });

                if (!nameFilled) {
                    const cakeNameEle = document.getElementById("cake");
                    const cookieNameEle = document.getElementById("cookie");
                    const dessertNameEle = document.getElementById("dessert");
                    if (cakeNameEle || cookieNameEle || dessertNameEle) {
                        cakeNameEle.innerHTML = cakeView;
                        cookieNameEle.innerHTML = cookieView;
                        dessertNameEle.innerHTML = dessertView;
                        nameFilled = true;
                    }
                }

                for (let x = 0; x < mNum; x++) {
                    const newCakeNameEle = document.getElementById("newCake" + x);
                    const newCookieNameEle = document.getElementById("newCookie" + x);
                    const newDessertNameEle = document.getElementById("newDessert" + x);
                    if (newCakeNameEle || newCookieNameEle || newDessertNameEle) {
                        newCakeNameEle.innerHTML = cakeView;
                        newCookieNameEle.innerHTML = cookieView;
                        newDessertNameEle.innerHTML = dessertView;
                    }
                }
            }

            function universalNums() {
                var mNum = $("#makeNum option:selected").val();

                // console.log(mNum);
                let view2 = '<option style="display: none;" value="">品項數量</option>';
                for (let i = 1; i <= mNum; i++) {
                    view2 += `
                        <option value=${i}>${i}份</option>
                    `;
                }

                if (!numFilled) {
                    const numElement = document.getElementById("num");
                    if (numElement) {
                        numElement.innerHTML = view2;
                        numFilled = true;
                    }
                }

                for (let x = 0; x < mNum; x++) {
                    const newNumElement = document.getElementById("newNum" + x);
                    if (newNumElement) {
                        newNumElement.innerHTML = view2;
                    }
                }
            }
        });
        
        function hideNewDivs(num) {
            const newDivs = $("[id^='newdiv']");
            $("#newdiv" + num).hide();
        }

        window.onload = function (e) {
            e.preventDefault();
            submitBtn.onclick = function (e) {
                const ckCakeName = $("#cakeName option:selected").val();
                const mNum = $("#makeNum option:selected").val();
                const ckNum = $("#num option:selected").val();

                const newDivs = $("[id^='newdiv']");
                for (let i = 0; i < newDivs.length; i++) {
                    if (!$(newDivs[i]).is(':hidden')) {
                        const newCakeName = $(newDivs[i]).find("[id^='newCakeName']").val();
                        const newNum = $(newDivs[i]).find("[id^='newNum']").val();
                        console.log(newCakeName);
                        console.log(newNum);

                        if (!newCakeName || !newNum) {
                            alert("請選擇新建的產品和份數");
                            return;
                        }
                    }
                }

                if (!ckCakeName || !ckNum) {
                    alert("請選擇產品和份數");
                    return;
                } else {
                    fetch('./php/reserve/insertOrdersCake.php', {
                        method: "POST",
                        body: new FormData(productForm)
                    })
                        .then(function (response) {
                            return response.text();
                        })
                        .then(function (data) {
                            console.log(data);
                            // if (data == "reserveProduct.php") {
                            //     location.href = data;
                            // } else {
                            //     let view = '';
                            //     view += `
                            //         <div>${data}</div>
                            //     `;
                            //     document.getElementById("test").innerHTML = view
                            // }
                        })
                }
            }
        }
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
        <h2>預約</h2>
        <div class="scd-container">
            <form id="productForm">
                <div>目前預定人數
                    <input type="hidden" id="oid" name="oid" value="<?= $cInfo[0]["oid"] ?>">
                    <input type="text" id="people" value="<?= $cInfo[0]["people"] ?>" disabled>
                    <label for="makeNum">製作份數</label>
                    <select id="makeNum" name="makeNum">
                    </select>
                    <span>陪同人數:</span><input type="text" id="companion" name="companion" value="0" readonly="readonly">
                </div>
                <div>注意：一份甜點最多一位陪同，將酌收陪同費120元/人。</div>

                <br><br>
                <div id="hidden">
                    <div id="baseChoose">
                        <label for="cakeName">選擇產品</label>
                        <select id="cakeName" name="cakeName">
                            <option style="display: none;" value="">請選擇產品</option>
                            <optgroup label="蛋糕" id="cake">
                            <optgroup label="餅乾" id="cookie">
                            <optgroup label="點心" id="dessert">
                        </select>
                        <label for="num">份數</label>
                        <select id="num" name="num">
                        </select>
                    </div>
                    <div id="newChoose"></div>

                    <input type="button" id="addnewdiv" value="新增品項">
                    <div>注意：若選取的甜點份數未滿製作份數，剩餘份數可現場到實體店面再做確認製作項目</div>
                    <br>
                    <input type="button" value="確認產品" id="submitBtn">
                </div>
            </form>
        </div>
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
<script src="../resources/js/navbar.js"></script>

</html>