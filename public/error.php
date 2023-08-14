<?php

isset($_GET["error_code"]);

$error_code = $_GET["error_code"];

switch ($error_code) {
    case 0:
        $error_msg = "系統錯誤";
        break;
    case 1:
        $error_msg = "存在非正常oToken，請聯絡相關負責人";
        break;
    case 2:
        $error_msg = "此訂單已經取消";
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../resources/css/Navbar.css">
    <link rel="stylesheet" href="../resources/css/login.css">
    <link rel="stylesheet" href="../resources/css/footer2.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" href="../resources/css/reserve1.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

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

    <h3>錯誤</h3>
    <div class="container">
        <h2>錯誤</h2>
        <div style="text-align:center">
            <?= $error_msg; ?>
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
<script src="../resources/js/login.js"></script>
<script src="../resources/js/topBtn.js"></script>
<script src="../resources/js/navbar.js"></script>

</html>