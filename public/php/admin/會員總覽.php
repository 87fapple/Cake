<?php session_start(); ?>
<?php
// if (!$_COOKIE['token']) {
//     header('Location: /Cake/public/login.html');
//     die();
// }


require('../db2.php');

$sql = "select * from userinfo where not uName = '管理員'";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../resources/css/Navbar.css">
    <link rel="stylesheet" href="../../../resources/css/history.css">
    <link rel="stylesheet" href="../../../resources/css/footer2.css">
    <link rel="stylesheet" href="../../../resources/js/topBtn.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/6c4c2bf9f6.js" crossorigin="anonymous"></script>

    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
</head>

<body>
    <!-- Back-to-Top Button -->
    <button onclick="topFunction()" class="topBtn" id="topBtn"></button>



    <div name="selecttop" id="sel">
        <a href="../public/admin.html" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp修改首頁輪播</a>
        <a href="../public/admin_addProduct.html" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp新增產品</a>
        <a href="../public/admin_changeProduct.html" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp修改產品資訊
        </a>
        <a href="../public/admin_reserveHistory.html" class="selectarea"><i style='font-size:24px' class='fas'>&#xf1b0;</i>&nbsp顧客預約總覽</a>
        <div class="selectarea"> 您好，<span>管理員</span></div>
    </div>

    <div id="">
        <div id="">
            <h2>會員約總覽</h2>
        </div>

        <br>
        <br>
        <table>
            <tr class="mainTable">
                <th>會員編號</th>
                <th>名稱</th>
                <th>信箱</th>
                <th>電話</th>
                <th>修改</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                echo
                '<tr class="mainTable">
                        <td>' . $row['uid'] . '</td>
                        <td>' . $row['uName'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td >' . $row['phone'] . '</td>
                        <td id="button"><button>修改資料</button></td>
                    </tr>';
            }
            ?>
            <table>
                <script src="../../../resources/js/topBtn.js"></script>
                <script src="../../../resources/js/navbar.js"></script>

</body>
</html>