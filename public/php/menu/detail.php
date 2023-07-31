<?php
require_once('../DB.php');

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
    <link rel="stylesheet" href="../resources/css/Carousel.css">
    <link rel="stylesheet" href="../resources/css/detailStyle.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<style>

</style>

<body>
    <!-- Back-to-Top Button -->
    <button onclick="topFunction()" class="topBtn" id="topBtn"></button>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbarTitle">
            <a href="/Cake/public/mainpage.html"><img src="/Cake/image/icon.png"></a>
        </div>
        <div class="hambuger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="navbarLink">
            <ul>
                <li><a href="">關於我們</a></li>
                <li><a href="">產品介紹</a></li>
                <li><a href="">登入會員</a></li>
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
                    <img src="/Cake/image/DetailImg/detailImg1.jpg">
                    <img src="/Cake/image/DetailImg/detailImg2.jpg">
                    <img src="/Cake/image/DetailImg/detailImg3.jpg">
                </div>
                <ul id="dots" class="dots">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <!-- Product Content -->
            <div class="productContent">
                <h1>蛋糕蛋糕</h1>
                <ul class="productList">
                    <li>難度：</li>
                    <li>時間：</li>
                    <li>價格：</li>
                </ul>
                <a href="" class="bookingBtn">預約</a>
            </div>
        </div>
        <!-- Detail -->
        <div class="detailBlock">
            <ul class="detailNavbar">
                <li><a href="">詳細內容</a></li>
                <li><a href="">使用材料</a></li>
                <li><a href="">客戶回饋</a></li>
            </ul>
            <section class="detailContent">
                <h1>詳細詳細</h1>
                <p>
                    內容<br>
                    內容<br>
                    內容<br>
                    內容<br>
                    內容<br>
                    內容<br>
                    內容<br>
                    內容<br>
                    內容<br>
                </p>
            
                <h1>使用材料</h1>
                <p>
                    材料<br>
                    材料<br>
                    材料<br>
                    材料<br>
                    材料<br>
                    材料<br>
                    材料<br>
                </p>
        
                <h1>顧客回饋</h1>
                <p>
                    回饋<br>
                    回饋<br>
                    回饋<br>
                    回饋<br>
                    回饋<br>
                    回饋<br>
                    回饋<br>
                </p>

                <a href="" class="bookingBtn">預約</a>
            </section>
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
<script src="/Cake/resources/js/navbar.js"></script>
<script src="/Cake/resources/js/topBtn.js"></script>
<script src="/Cake/resources/js/Carousel.js"></script>


</html>