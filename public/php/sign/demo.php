<?php session_start(); ?>
<?php

require('../db2.php');

$token = '4732438d-2c8a-11ee-83bb-0242ac110004';

$sql = "select orders.uid,orders.people,orders.reserveDate,orders.reserveTime,store.location ,cake.cName 
from orders 
inner join userinfo  on userinfo.uid = orders.uid
inner join orderlist on orders.oid = orderlist.oid
inner join cake on cake.cid = orderlist.cid
inner join storetocake on storetocake.cid = orderlist.cid
inner join store on store.sid = storetocake.sid
where token = '4732438d-2c8a-11ee-83bb-0242ac110004' 
";
$stmt = $mysqli->prepare($sql);
// $stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();
// $row = $result->fetch_assoc();


// $cName=$row[0]['cName'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>預約紀錄</title>
    <link rel="stylesheet" href="../../../resources/css/navbar.css">
    <link rel="stylesheet" href="../../../resources/css/history.css">
    <link rel="stylesheet" href="../../../resources/css/footer.css">
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

                <?php
                while($row=$result->fetch_assoc()){
                    // echo "<pre/>";
                    // var_dump($row);
                    echo'<tr class="mainTable">
                        <td>' . $row['reserveDate'] . '</td>
                        <td>'. $row['location'] .'</td>
                        <td>'. $row['reserveTime'] .'</td>
                        <td id="products">'. $row['cName'] .'</td>
                        <td>'. $row['people'] . '人</td>
                        <td id="button"><button>取消預約</button></td>
                    </tr>';
                }
                ?>

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