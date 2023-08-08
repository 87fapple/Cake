<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
  header('Location: /Cake/public/login.html');
  die();
}
require('php/db2.php');
$token = $_COOKIE['token'];

$sql = ' SELECT * FROM userinfo where token=? ';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$email=$row['email'];
$uName=$row['uName'];
$phone=$row['phone'];
setcookie('user', $uName, time() + 1200, "/");
// echo $uName;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="../resources/css/Navbar.css">
  <link rel="stylesheet" href="../resources/css/member.css">
  <link rel="stylesheet" href="../resources/css/footer2.css">
  <link rel="stylesheet" href="../resources/css/topBtn.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <script src="https://kit.fontawesome.com/6c4c2bf9f6.js" crossorigin="anonymous"></script>

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
      <ul>
        <li><a href="../public/menu.php">產品介紹</a></li>
        <li><a href="../public/locations.html">分店資訊</a></li>
        <li><a href="../public/reserve.php">預約課程</a></li>
        <li><a href="../public/Q&A.html">常見問題</a></li>
        <li><a href="php/sign/logout.php">登出</a></li>
      </ul>
    </div>
  </nav>

  <div name="selectarea" id="sel">
    <a href="./admin.html" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp更改會員資料</a>
    <a href="./history.php" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp預約紀錄</a>
    <div class="selectarea"> 您好，<span><?= $uName ?></span></div>

  </div>

  <div id="contents">

    <h2>更改會員資料</h2>

    <div class="container">
      <form action="php/sign/update.php">
        <label for="nickname">暱稱</label>
        <input type="text" id="uname" name="uname" value="<?= $uName ?>">
        <br>
        <label for="newemailadd">信箱</label>
        <input type="email" id="email" name="email" value="<?= $email ?>">
        <br>
        <label for="newphone">手機號碼</label>
        <input type="phone" id="phone" name="phone" value="<?= $phone ?>">
        <br>
        <label for="newpwd">密碼</label>
        <input type="password" id="pwd" name="pwd" placeholder="更改密碼">
        <br>
        <label for="cfrpwd">確認密碼</label>
        <input type="password" id="cfrpwd" name="cfrpwd" placeholder="再次輸入密碼">
        <br>
        <br>
        <input type="submit" value="確認更改" class="comfirmbtn">
      </form>
    </div>
    <br>
  </div>

  <br><br><br>
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

</html>