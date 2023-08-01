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
    <link rel="stylesheet" href="../resources/css/menuStyle.css">   
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="stylesheet" href="../resources/css/footer.css">
    <link rel="stylesheet" href="../resources/css/topBtn.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<!-- <style>
    .kindBlock {
        display: flex;
    }

    .kindBlock div {
        margin: 16px;
        font-size: 18px;
    }


    /* The container */
    .container {
    display: block;
    position: relative;
    top: 16px;
    padding-left: 32px;
    margin-right: 8px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    /* Hide the browser's default radio button */
    .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
    background-color: #ffbf00;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked ~ .checkmark {
    background-color: #ffa237;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
    content: "";
    position: absolute;
    display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container input:checked ~ .checkmark:after {
    display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
    }

    .dropbtn {
    background-color: #ffa237;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    }

    .dropdown {
    position: relative;
    display: inline-block;
    }

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }

    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    .dropdown-content a:hover {background-color: #ddd;}
    .dropdown:hover .dropdown-content {display: block;}
    .dropdown:hover .dropbtn {background-color: #ffbf00;}
</style> -->

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

    <!-- Menu -->
    <main class="menu">
        <!-- Welcome img and title -->
        <div class="menuBlock1">
            <img src="../image/menuImg/menuWelcomeImg.jpg">
            <p>所有產品</p>
        </div>
        <!-- Type Navbar -->
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
                    <a herf="javascript:void(0);" onclick="priceSortAsc()">價格：由低到高</a>
                    <a herf="javascript:void(0);" onclick="priceSortDesc()">價格：由高到低</a>
                </div>
            </div>
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
// 蛋糕種類篩選 2.0
function kindFilter(kind) {
    fetch(`php/menu/kindfilter.php?kind=${kind}`)
        .then(response => response.json())
        .then(sortedCakes => {
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