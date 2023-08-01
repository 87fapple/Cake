<?php session_start(); ?>
<?php
require_once('../DB.php');

// if (isset($_COOKIE["oToken"])) {
//     $oToken = $_COOKIE["oToken"];
// }

$oToken = 'b2729291-2f66-11ee-b7cc-0242ac110004';
$cInfo = [];

DB::select("select * from orders where oToken = ?", function ($rows) use (&$cInfo) {
    $cInfo[] = $rows[0];
}, [$oToken]);

var_dump($cInfo[0]);
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $(function () {
            var people = $("#people").val();
            let view1 = '<option style="display: none;">請選擇製作份數</option>';
            var numList = [];
            for (var i = Math.round(people / 2); i <= people; i++) {
                view1 += `
                            <option value=${i}>${i}份</option>
                        `;
            }
            document.getElementById("makeNum").innerHTML = view1

            $("#makeNum").on('change', function (e) {
                var mNum = $("#makeNum option:selected");
                var mNumVal = mNum.val();
                var people = $("#people").val();
                let view2 = '';

                $("#companion").val(people - mNumVal);

                for (var i = 1; i <= mNumVal; i++) {
                    view2 += `
                            <option value=${i}>${i}份</option>
                        `;
                }
                document.getElementById("num").innerHTML = view2
            })

            document.getElementById("addnewdiv").onclick = function (e) {
                function 
                let view4 = '';
                view4 = `
                <div id="newdiv">
                    <label for="newCakeName">選擇產品</label>
                    <select id="newCakeName" name="newCakeName">
                        <option value="皮卡蛋糕">皮卡蛋糕</option>
                    </select>
                    <label for="num">份數</label>
                    <select id="num" name="num">
                        <option value="1">一份</option>
                        <option value="2">兩份</option>
                    </select>
                </div>
                `;
                $("#baseChoose").append(view4);
            }

            fetch(`storeToCake_sql.php?indexInfo=<?= $cInfo[0]["sid"] ?>`,)
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    console.log(data);
                    let view3 = '<option style="display: none;">請選擇產品</option>';
                    data.forEach(function (e2) {
                        view3 += `
                            <option value="${e2.cid}">${e2.cName}</option>
                        `
                    })
                    document.getElementById("cakeName").innerHTML = view3
                })

            
        });

        window.onload = function (e) {
            e.preventDefault();
            submitBtn.onclick = function (e) {
                fetch('insertOrdersCake.php', {
                    method: "POST",
                    body: new FormData(productForm)
                })
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (data) {
                        console.log(data);
                        // if (data == "reserveProduct.php") {
                        //     location.href = data;
                        // } else {
                        //     let view = '';
                        //     view += `
                        //         <div>${data}</div>
                        //     `;
                        //     document.getElementById("test").innerHTML = view
                        // }
                    })
            }
        }
    </script>
</head>

<body>
    <div class="topnav">
        <a href="#logout">登入/註冊</a>
        <a href="#contact">常見問題</a>
        <a href="#news">商品介紹</a>
        <a href="#reserve">預約課程</a>
        <a href="#location">分店資訊</a>
    </div>

    <h3>預約產品</h3>
    <div class="container">
        <form id="productForm">
            <div>目前預定人數
                <input type="text" id="people" value="<?= $cInfo[0]["people"] ?>" disabled>
                <label for="makeNum">製作份數</label>
                <select id="makeNum" name="makeNum">
                </select>
                <span>陪同人數:</span><input type="text" id="companion" name="companion" value="0" readonly="readonly">
            </div>
            <div>注意：一份甜點最多一位陪同，將酌收陪同費120元/人。</div>
            <div id="baseChoose">
                <label for="cakeName">選擇產品</label>
                <select id="cakeName" name="cakeName">
                </select>
                <label for="num">份數</label>
                <select id="num" name="num">
                    <option style="display: none;">製作份數</option>
                </select>
            </div>

            <input type="button" id="addnewdiv" value="新增品項">
            <div>注意：若選取的甜點份數未滿製作份數，剩餘份數可現場到實體店面再做確認製作項目</div>

            <!-- <div id="newdiv">
                <label for="newCakeName">選擇產品</label>
                <select id="newCakeName" name="newCakeName">
                    <option value="皮卡蛋糕">皮卡蛋糕</option>
                </select>
                <label for="num">份數</label>
                <select id="num" name="num">
                    <option value="1">一份</option>
                    <option value="2">兩份</option>
                </select>
            </div> -->
            <br>

            <br>
            <input type="button" value="確認產品" id="submitBtn">
        </form>
    </div>
    <script>

    </script>



</body>

</html>