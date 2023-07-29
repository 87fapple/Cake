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

echo $uName;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="../resources/css/navbar.css">
  <link rel="stylesheet" href="../resources/css/member.css">
  <link rel="stylesheet" href="../resources/css/footer.css">


</head>

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

  <div name="selectarea" id="sel">
    <div href="#changeData" class="selectarea"> <a href="./admin.html">更改會員資料</a></div>
    <div href="#reserveHistory" class="selectarea"><a href="./history.html">預約紀錄</a></div>
    <div class="selectarea"> 您好，<span><?= $uName ?></span></div>
  </div>


  <div id="contents">

    <h2>更改會員資料</h2>

    <div class="container">
      <form action="php/sign/update.php">
        <label for="nickname">暱稱</label>
        <input type="text" id="uname" name="uname" value="<?= $uName ?>" />
        <br>
        <label for="email">信箱</label>
        <input type="email" id="email" name="email" value="<?= $email ?>"/>
        <br>
        <label for="phone">手機號碼</label>
        <input type="phone" id="phone" name="phone" value="<?= $phone ?>"/>
        <br>
        <label for="newpwd">密碼</label>
        <input type="password" id="pwd" name="pwd" placeholder="更改密碼">
        <br>
        <label for="cfrpwd">確認密碼</label>
        <input type="password" id="cfrpwd" name="cfrpwd" placeholder="再次輸入密碼">
        <br>
        <input type="submit" value="確認更改" class="comfirmbtn">
      </form>
    </div>
    <br>
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

</html>