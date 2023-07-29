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
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="stylesheet" href="../resources/css/history.css">
    <link rel="stylesheet" href="../resources/css/footer.css">
</head>

<body>

    <body>
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
                    <li><a href="../pubilc/menu.html">產品介紹</a></li>
                    <li><a href="../public/locations.html">分店資訊</a></li>
                    <li><a href="../public/reserve.html">預約課程</a></li>
                    <li><a href="../public/Q&A.html">常見問題</a></li>
                    <li><a href="php/sign/logout.php">登出</a></li>
                </ul>
            </div>
        </nav>

        <div name="selecttop" id="sel">
            <div href="#changeToppic" class="selectarea">修改首頁輪播</div>
            <div href="#addProduct" class="selectarea">新增產品</div>
            <div href="#modifyProduct" class="selectarea">修改產品資訊</div>
            <div href="#allreserve" class="selectarea">顧客預約總覽</div>
            <div class="selectarea"> 您好，<span>使用者</span></div>
        </div>

        <div id="">
            <div id="">
                <h2>預約紀錄</h2>
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

</html>