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
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="stylesheet" href="../resources/css/footer.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" href="../resources/css/menuStyle.css">
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
                <li><a href="../public/menu.html">產品介紹</a></li>
                <li><a href="../public/locations.html">分店資訊</a></li>
                <li><a href="../public/reserve.html">預約課程</a></li>
                <li><a href="../public/Q&A.html">常見問題</a></li>
                <li><a href="../public/login.html">登入會員</a></li>
            </ul>
        </div>
    </nav>

    <!-- Menu -->
    <main class="menu">
        <!-- Welcome img and title -->
        <div class="menuBlock1">
            <img src="../image/menuImg/menuWelcomeImg.jpg">
            <p>所有產品</p>
        </div>
        <!-- Type Navbar -->
        <div class="kindNavbar" id="kindNavbar">
            <div>
                <input type="checkbox" name="cake" id="cake" onclick="kindCake()">    
                <label for="cake">蛋糕</label>
            </div>
            <div>
                <input type="checkbox" name="cookie" id="cookie" onclick="kindCookie()">
                <label for="cookie">餅乾</label>
            </div>
            <button onclick="priceSortAsc()">按價格排序低到高</button>
            <button onclick="priceSortDesc()">按價格排序高到低</button>
        </div>
        <!-- Menu Info -->
        <div class="menuBlock2">
        <?php
            while($row = $result->fetch_assoc()){
                echo 
                    "
                    <div class=\"menuInfoDiv\" id=\"menuInfo\">
                        <a href=\"\"><img src=\"../image/menuImg/menuInfo1.jpg\"></a>
                        <div class=\"menuInfoContent\" id=\"menuInfoContent\">
                            <ul class=\"menuInfo\" id=\"menuInfo\">
                                <li>名稱：{$row['cName']}</li>
                                <li>時間：2hr</li>
                                <li>難度：{$row['level']}</li>
                                <li>價格：{$row['price']}</li>
                            </ul>
                        </div>
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

</body>
<script src="../resources/js/navbar.js"></script>
<script src="../resources/js/topBtn.js"></script>
    
<script>
//  蛋糕種類篩選ajax 
function kindCake() {
    fetch('php/menu/kindcake.php')
        .then(response => response.json())
        .then(sortedCakes => {
            renderCakes(sortedCakes);
        })
        .catch(error => console.error('請求失敗：', error));
}
function kindCookie() {
    fetch('php/menu/kindcookie.php')
        .then(response => response.json())
        .then(sortedCakes => {
            renderCakes(sortedCakes);
        })
        .catch(error => console.error('請求失敗：', error));
}
//  價格排序ajax 
function priceSortAsc() {
    fetch('php/menu/priceasc.php')
        .then(response => response.json())
        .then(sortedCakes => {
            renderCakes(sortedCakes);
        })
        .catch(error => console.error('請求失敗：', error));
}
function priceSortDesc() {
    fetch('php/menu/pricedesc.php')
        .then(response => response.json())
        .then(sortedCakes => {
            renderCakes(sortedCakes);
        })
        .catch(error => console.error('請求失敗：', error));
}
// 畫面render
function renderCakes(cakes) {
    var menuBlock2 = document.querySelector('.menuBlock2');
    menuBlock2.innerHTML = '';

    cakes.forEach(cake => {
        menuBlock2.innerHTML += `
            <div class="menuInfoDiv" id="menuInfo">
                <a href=""><img src="../image/menuImg/menuInfo1.jpg"></a>
                <div class="menuInfoContent" id="menuInfoContent">
                    <ul class="menuInfo" id="menuInfo">
                        <li>名稱：${cake.cName}</li>
                        <li>時間：2hr</li>
                        <li>難度：${cake.level}</li>
                        <li>價格：${cake.price}</li>
                    </ul>
                </div>
            </div>
        `;
    });
}
</script>

</html>