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
    <title>預約紀錄</title>
    <link rel="stylesheet" href="../resources/css/Navbar.css">
    <link rel="stylesheet" href="../resources/css/history.css">
    <link rel="stylesheet" href="../resources/css/footer2.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/6c4c2bf9f6.js" crossorigin="anonymous"></script>

</head>

<body>

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

    <div name="selecttop" id="sel">
        <a href="../public/admin.html" class="selectarea"><i style='font-size:24px'
                class='fas'>&#xf1b0;</i>&nbsp更改會員資料</a>
        <a href="../public/admin_addProduct.html" class="selectarea"><i style='font-size:24px'
                class='fas'>&#xf1b0;</i>&nbsp預約紀錄</a>
        <div class="selectarea"> 您好，<span>使用者</span></div>
    </div>

        <div id="">
            <div id="">
                <h2>預約紀錄</hㄉ>
            </div>

            <table>
                <tr class="mainTable">
                    <th>日期</th>
                    <th>分店</th>
                    <th>時段</th>
                    <th>產品</th>
                    <th>總人數</th>
                    <th>是否取消</th>
                </tr>

                <tr class="mainTable">
                    <td>2023/7/6</td>
                    <td>皮卡丘店</td>
                    <td>13:00-15:00</td>
                    <td id="products">小火龍餅乾X2、皮卡丘蛋糕X1</td>
                    <td>3人</td>
                    <td id="button"><button>取消預約</button></td>
                </tr>

                <tr class="mainTable">
                    <td>2023/7/6</td>
                    <td>皮卡丘店</td>
                    <td>13:00-15:00</td>
                    <td id="products">小火龍餅乾</td>
                    <td>1人</td>
                    <td>已取消</td>
                </tr>
            </table>


            <br>
        <br>
        <br>
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