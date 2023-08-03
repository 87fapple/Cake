<?php
require_once('php/db2.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="stylesheet" href="../resources/css/footer.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" href="../resources/css/carousel.css">
    <link rel="stylesheet" href="../resources/css/detail.css">
    <!-- <link rel="stylesheet" href="../resources/css/detailStyle.css"> -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <!-- Back-to-Top Button -->
    <button onclick="topFunction()" class="topBtn" id="topBtn"></button>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbarTitle">
            <a href="../public/mainpage.html"><img src="../image/icon-noBorder-whiteFont.png"></a>
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
                <li><a href="../public/reserve.html">預約課程</a></li>
                <li><a href="../public/Q&A.html">常見問題</a></li>
                <li><a href="../public/login.html">登入會員</a></li>
            </ul>
        </div>
    </nav>

    <!-- Product Details -->
    <main class="detailContainer">
        <!-- Product -->
        <div class="productBlock">
            <!-- Carousel Img -->
            <div class="carouselContainer">
                <span id="carouselPrevious">＜</span>
                <span id="carouselNext">＞</span>
                <div id="slider" class="slider">
                    <img src="../image/DetailImg/detailImg1.jpg">
                    <img src="../image/DetailImg/detailImg2.jpg">
                    <img src="../image/DetailImg/detailImg3.jpg">
                </div>
                <ul id="dots" class="dots">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <!-- Product Content -->
            <div class="productContent">
                <h1>皮卡蛋糕</h1>
                <ul class="productList">
                    <li>尺寸： 6吋</li>
                    <li>難度： 5</li>
                    <li>價格： 200元</li>
                </ul>
                <a href="../public/reserve.html" class="bookingBtn">預約</a>
            </div>
        </div>

        <!-- Detail -->
        <div class="detailBlock">
            <ul class="detailNavbar">
                <li><a href="#detail">詳細內容</a></li>
                <li><a href="#material">使用材料</a></li>
                <li><a href="#experience">製作心得</a></li>
            </ul>

            <!-- Detail Content Block -->
            <section class="detailContent">
                <h1 id="detail">詳細內容</h1>
                <pre>
                    "🏠提供製作：所有分店\n

                    [蛋奶素]\n
                    主體：伯爵茶餅乾\n
                    尺寸約：長5cm、寬3cm、高1cm\n
                    🎁附手提紙盒一個 (20片裝一起)\n"
                </pre>

                <h1 id="material">使用材料</h1>
                <pre>
                    "OREO 餅乾（ 2 盒）\n
                    鮮奶油（ 400ml ）\n
                    奶油乳酪（ 400ml ）\n
                    無鹽奶油（ 20g ）\n
                    香草精（少量）\
                    糖（ 70g ）\n"
                </pre>

                <h1 id="experience">製作心得</h1>
                <div class="expBlock">
                    <h4>userName</h4>
                    <pre>
                        分享這次DIY的過程，非常有趣
                    </pre>
                    <div class="expImgBlock">
                        <img src="../image/mainImg/mainImg1.jpg" alt="">
                        <img src="../image/mainImg/mainImg1.jpg" alt="">
                        <img src="../image/mainImg/mainImg1.jpg" alt="">
                        <img src="../image/mainImg/mainImg1.jpg" alt="">
                    </div>
                    <p>2023/7/10 10:00:00</p>
                </div>

            </section>
            <a href="./reserve.html" class="bookingBtn">預約</a>
        </div>
    </main>

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
<script src="../resources/js/navbar.js"></script>
<script src="../resources/js/topBtn.js"></script>
<script src="../resources/js/Carousel.js"></script>


</html>