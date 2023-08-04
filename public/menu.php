<?php
require_once('php/db2.php');

$sql = 'select * from cake';
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../resources/css/menu2.css">   
    <link rel="stylesheet" href="../resources/css/Navbar.css">
    <link rel="stylesheet" href="../resources/css/footer2.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
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

    <!-- Menu -->
    <main class="menu">
        <!-- Welcome img and title -->
        <!-- <div class="menuBlock1">
            <img src="../image/menuImg/menuWelcomeImg.jpg">
            <p >所有產品</p>
        </div>

        <!- Type Navbar -->
        <p style="margin:120px 0 0 0 "></p>
        <div class="kindNavbar" id="kindNavbar">
            <div class="kindBlock">
                <div><b>選擇種類：</b></div> 
                <label class="container">蛋糕
                    <input type="radio" checked="checked" name="radio" id="cake" onclick="kindCake()">   
                    <span class="checkmark"></span>
                </label>
                <label class="container">餅乾
                    <input type="radio" name="radio" id="cookie" onclick="kindCookie()">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="dropdown">
                <button class="dropbtn">排序方式</button>
                <div class="dropdown-content">
                    <a herf="javascript:void(0);" onclick="priceSort('asc')">價格：由低到高</a>
                    <a herf="javascript:void(0);" onclick="priceSort('desc')">價格：由高到低</a>
                </div>
            </div>
        </div>

        <!-- Menu Info -->
        <div class="menuBlock2">
            
        <?php
            while($row = $result->fetch_assoc()){
                echo 
                    "
                    <div class=\"menuInfoDiv\" id=\"menuInfo\" data-cakeid={$row['cid']}>
                        <a href=\"\"><img src=\"../image/menuImg/menuInfo1.jpg\" onclick=\"showProductDetail({$row['cid']})\">
                        <div class=\"menuInfoContent\" id=\"menuInfoContent\" >
                            <ul class=\"menuInfo\" id=\"menuInfo\">
                                <li>{$row['cName']}</li>
                                <li>難度 {$row['level']}</li>
                                <li>$ {$row['price']}</li>
                            </ul>
                        </div></a>
                    </div>
                    ";
            }
        ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer" style="margin-top: 64px;">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 在這裡放你的 JavaScript 程式碼，包括綁定點擊事件
            // 例如：綁定點擊事件到已生成的 menuInfoDiv
            const menuInfoDivs = document.querySelectorAll('.menuInfoDiv');
            menuInfoDivs.forEach(div => {
                const cakeId = div.getAttribute('data-cakeid');
                div.addEventListener('click', function () {
                    showProductDetail(cakeId);
                });
            });
        });
    </script>
</body>
<script src="../resources/js/navbar.js"></script>
<script src="../resources/js/topBtn.js"></script>
    
<script>

// 在此添加全局变量来记录客人点击的种类
let selectedKind = '';

// 蛋糕種類篩選 3.0
function kindFilter(kind) {
    fetch(`php/menu/kindfilter.php?kind=${kind}`)
        .then(response => response.json())
        .then(sortedCakes => {
            // 更新全局变量的值
            selectedKind = kind;
            renderCakes(sortedCakes);
        })
        .catch(error => console.error('請求失敗：', error));
}

function kindCake() {
    kindFilter('蛋糕');
}

function kindCookie() {
    kindFilter('餅乾');
}

// 接收排序方式参数，價格排序ajax 3.0 
function priceSort(sortType) {
    // 增加種類參數
    fetch(`php/menu/pricesort.php?sortType=${sortType}&kind=${selectedKind}`)
        .then(response => response.json())
        .then(sortedCakes => {
            renderCakes(sortedCakes);
        })
        .catch(error => console.error('請求失敗：', error));
}

// 畫面總攬render
function renderCakes(cakes) {
    var menuBlock2 = document.querySelector('.menuBlock2');
    menuBlock2.innerHTML = '';

    cakes.forEach(cake => {
        menuBlock2.innerHTML += `
            <div class="menuInfoDiv" id="menuInfo" data-cakeid="${cake.cid}" > <!-- 添加data-cakeid屬性 -->
                <a href="javascript:void(0);" onclick="showProductDetail(${cake.cid})"><img src="../image/menuImg/menuInfo1.jpg"></a> <!-- 修改onclick事件 -->
                <div class="menuInfoContent" id="menuInfoContent">
                    <ul class="menuInfo" id="menuInfo">
                        <li>${cake.cName}</li>
                        <li>難度${cake.level}</li>
                        <li>$${cake.price}</li>
                    </ul>
                </div>
            </div>
        `;
    });
}

// 點擊產品總攬其中一個div後
function showProductDetail(cakeId) {
        fetch(`php/menu/product_detail.php?cid=${cakeId}`)
            .then(response => {
                if (!response.ok) {
                    console.log(response);
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(cakeDetail => {
                // 在這裡調用新的JS函式detailRender()並將產品詳細資訊傳遞過去
                detailRender(cakeDetail);
            })
            .catch(error => console.error('請求失敗：', error));
    }

    function detailRender(cakeDetail) {
        var menu = document.querySelector('.menu');
        menu.innerHTML = `
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
                        <h1>${cakeDetail.cName}</h1>
                        <ul class="productList">
                            <li>尺寸： ${cakeDetail.size}</li>
                            <li>難度： ${cakeDetail.level}</li>
                            <li>價格： ${cakeDetail.price}</li>
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
                            ${cakeDetail.feature}
                        </pre>

                        <h1 id="material">使用材料</h1>
                        <pre>
                            ${cakeDetail.material}
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
        `;
    }
    
</script>

</html>