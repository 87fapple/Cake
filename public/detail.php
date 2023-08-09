<?php
require_once('php/db2.php');

    $cakeId = $_GET['cid'];

    // 使用預處理語句獲取指定ID的產品詳細資訊
    $sql = 'SELECT * FROM cake WHERE cid = ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $cakeId);
    $stmt->execute();
    $result = $stmt->get_result();
   
    $cakeDetail = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cakeDetail['cName']; ?></title>
    <link rel="stylesheet" href="../resources/css/Navbar.css">
    <link rel="stylesheet" href="../resources/css/footer2.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" href="../resources/css/carousel1.css">
    <link rel="stylesheet" href="../resources/css/detail2.css">
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
                <li><a href="../public/reserve.php">預約課程</a></li>
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
                    <img src="<?php echo $cakeDetail['cImg1']; ?>">
                    <img src="<?php echo $cakeDetail['cImg2']; ?>">
                </div>
                <ul id="dots" class="dots">
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <!-- Product Content -->
            <div class="productContent">
                <h1><?php echo $cakeDetail['cName']; ?></h1>
                <ul class="productList">
                    <li>尺寸： <?php echo $cakeDetail['cSize']; ?></li>
                    <li>難度： <?php echo $cakeDetail['level']; ?></li>
                    <li>價格： <?php echo $cakeDetail['price']; ?></li>
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
                <div class="detailContainer22">
                    <pre><?php echo $cakeDetail['feature']; ?></pre>
                </div>
                <h1 id="material">使用材料</h1>
                <div class="detailContainer22">
                    <pre><?php echo $cakeDetail['material']; ?></pre>
                </div>
                <h1 id="experience">製作心得</h1>

                <div class="slideshow-container">
                    <div class="detailContainer22 mySlides fade">
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

                    <div class="detailContainer22 mySlides fade">
                        <h4>userName</h4>
                        <pre>
                            分享這次DIY的過程，非常有趣2
                        </pre>
                        <div class="expImgBlock">
                            <img src="../image/mainImg/mainImg1.jpg" alt="">
                            <img src="../image/mainImg/mainImg1.jpg" alt="">
                            <img src="../image/mainImg/mainImg1.jpg" alt="">
                            <img src="../image/mainImg/mainImg1.jpg" alt="">
                        </div>
                        <p>2023/7/10 10:00:00</p>
                    </div>

                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>                

                </div>

                <!-- <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span> 
                    <span class="dot" onclick="currentSlide(2)"></span> 
                    <span class="dot" onclick="currentSlide(3)"></span> 
                </div> -->
            </section>
            <a href="./reserve.php" class="bookingBtn">預約</a>
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
<script src="../resources/js/detailCarousel.js"></script>

</html>
