<?php
if(isset($_COOKIE['token'])){
    require('../db2.php');

    $token = $_COOKIE['token'];
    
    $sql="select count(*) from userinfo where token=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s',$token);
    $stmt->execute();
    $result = $stmt->get_result();
    $row=$result->fetch_assoc();
    $count=$row['count(*)'];
    
    if($count===1){
        header('Content-Type: text/html; charset=utf-8');
    echo '<li><a href="../public/menu.php">產品介紹</a></li>
    <li><a href="../public/locations.html">分店資訊</a></li>
    <li><a href="../public/reserve.php">預約課程</a></li>
    <li><a href="../public/Q&A.html">常見問題</a></li>
    <li><a href="member.php">會員資料</a></li>
          <li><a href="php/sign/logout.php">登出</a></li>';
    }

}else{
    header('Content-Type: text/html; charset=utf-8');
    echo'<li><a href="../public/menu.php">產品介紹</a></li>
    <li><a href="../public/locations.html">分店資訊</a></li>
    <li><a href="../public/reserve.php">預約課程</a></li>
    <li><a href="../public/Q&A.html">常見問題</a></li>
    <li><a href="../public/login.html">登入會員</a></li>';
    return;
    
}
