<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}


require('php/db2.php');
require('php/DB.php');
$token = $_COOKIE['token'];

$uName = '';
DB::select("select uName from userinfo where token = ?", function ($rows) use (&$uName) {
    $uName = $rows[0]["uName"];
}, [$token]);

$sql = "select orders.oToken,orders.sid, orders.companion, orders.people,orders.reserveDate,orders.reserveTime,orders.remove,store.location , IFNULL(GROUP_CONCAT(cake.cName,'*',orderlist.num), '尚未選擇商品') as cName
from orders 
left join userinfo  on userinfo.uid = orders.uid
left join orderlist on orders.oid = orderlist.oid
left join cake on orderlist.cid = cake.cid
left join store on orders.sid= store.sid
where token = ?
 GROUP BY orders.oid
 order by orders.reserveDate
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $token);
$stmt->execute();

$result = $stmt->get_result();

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/6c4c2bf9f6.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="//unpkg.com/layui@2.7.6/dist/css/layui.css" /> -->
    <script src="//unpkg.com/layui@2.7.6/dist/layui.js"></script>
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<script>
</script>

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
                    <li><a href="../public/php/sign/logout.php">登出</a></li>
                </ul>
            </div>
        </nav>

        <div name="selecttop" id="sel">
            <a href="../public/member.php" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp更改會員資料</a>
            <a href="history.php" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp預約紀錄</a>
            <div class="selectarea"> 您好，<span><?= $uName; ?></span></div>
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
                    <th>製作份數</th>
                    <th>陪同人數</th>
                    <th>總人數</th>
                    <th>是否取消</th>
                    <th>修改訂單</th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) {
                    // echo "<pre/>";
                    // var_dump($row);
                    if ($row['remove'] === 0) {
                        $a = '<button class="btn">取消預約</button>';
                    } else {
                        $a = '<span>已取消</span>';
                    }
                    echo
                    '<tr class="mainTable">
                        <td>' . $row['reserveDate'] . '</td>
                        <td>' . $row['location'] . '</td>
                        <td>' . $row['reserveTime'] . '</td>
                        <td id="products">' . $row['cName'] . '</td>
                        <td>' . ($row['people'] - $row['companion']) . '人</td>
                        <td>' . $row['companion'] . '人</td>
                        <td>' . $row['people'] . '人</td>
                        <td class="td-btn" >' . $a . '</td>
                        <td><input class="getOid" type="button" value="修改" data-oToken="' . $row["oToken"] . '"></td>
                    </tr>';
                }
                ?>

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
    <script src="../resources/js/navbar.js"></script>
    <script>
        const btn = document.querySelectorAll(".btn");
        const tdbtn = document.querySelectorAll(".td-btn");

        btn.forEach(function(item) {
            console.log(item);
            item.addEventListener("click", function(e) {
                layer.alert('手做蛋糕DIY', {
                    title: ['確定要取消預約嗎?', 'font-size:18px;'],
                    time: 0,
                    btn: ["確定", "在考慮一下"],
                    yes: function(index) {
                        e.target.parentNode.innerHTML = '<span>已取消</span>'
                        layer.close(index);
                    },
                });
            })
        })

        const btns = document.querySelectorAll(".getOid");

        btns.forEach(function(btn) {
            btn.addEventListener("click", function(e) {
                const oToken = e.target.getAttribute("data-oToken");
                layer.alert('是否前往修改訂單?', {
                    title: ['提示', 'font-size:18px;'],
                    time: 0,
                    btn: ["確定", "在考慮一下"],
                    yes: function(index) {
                        window.location.href = `reserve.php?oToken=${oToken}`;
                    },
                });
            });
        });
    </script>

</html>