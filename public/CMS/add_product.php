<?php $title = 'CMS Add Product'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '新增品項'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>



<!-- <link rel="stylesheet" href="./CMS_css/add_product.css"/> -->

<!-- icon引用 -->
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<script src="https://kit.fontawesome.com/6c4c2bf9f6.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css
" rel="stylesheet">


<style>
    .container {
        width: calc(100% - 200px);
        position: relative;
        top: 52px;
        left: 200px;
    }

    .box {
        background-color: #fff5d6c4;
        width: calc(95% - 200px);
        margin: 32px 2.5% 72px;
        border: 2px solid #885500;
        border-radius: 12px;
    }

    .box h2,
    .box form {
        margin: 32px;
    }

    .box form {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: space-evenly;
    }

    .box form .mid_Box {
        width: 280px;
        height: 320px;
        margin: 0 4px;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
    }

    .box form .mid_Box:nth-child(2) {
        position: relative;
    }

    .box form .input_Box {
        display: block;
        width: 250px;
        height: 56px;
    }

    .box form .input_Box label {
        display: inline-block;
        width: 110px;
    }

    .box form .input_Box input,
    .box form .input_Box select {
        width: 200px;
        height: 24px;
    }

    .text_Box {
        margin: 8px;
    }

    .text_Box textarea {
        width: 260px;
        height: 100px;
        resize: none;
        font-size: 0.5rem;
    }

    .mid_Box .img_Box {
        width: 280px;
        height: 120px;
        z-index: 3;
    }

    .img_Box img {
        width: 200px;
        height: 140px;
    }


    .box form div input[type="submit"] {
        width: 80px;
        margin-top: 52px;
        padding: 4px;
        border: 2px solid #ffa237;
        border-radius: 6px;
        background-color: #ffa237;
    }

    .box form div input[type="submit"]:hover {
        border: 2px solid #ffbf00;
        background-color: #ffbf00;
    }

    .img_Box span:after {
        content: "\f1c5" "為上傳圖片";

        font-size: 16px;
        font-family: FontAwesome;
        color: rgb(100, 100, 100);

        display: inline-block;
        position: relative;
        right: 100px;

        z-index: 2;

        width: 110px;
        height: 25px;
        background-color: #fff;
    }
</style>

<body>
    <div class="container box" id="changeForm">
        <h2>新增產品資訊</h2>
        <form id="add_form" method="post" enctype="multipart/form-data">
            <!-- action="../php/admin/add.php" -->
            <div class="mid_Box">

                <div class="input_Box">
                    <label for="pname">產品名稱</label>
                    <input type="text" id="pname" name="pname" placeholder="請輸入產品名稱" required onfocus="re()" />
                </div>

                <div class="input_Box">
                    <label for="price">產品價格</label>
                    <input type="number" id="price" name="price" step="1" placeholder="請輸入價格" required />
                </div>

                <div class="input_Box">
                    <label for="level">難度</label>
                    <select name="level" id="level" class="select">
                        <option value="1"><span>★</span>小朋友都會</option>
                        <option value="2"><span>★★</span>適合大人初學者</option>
                        <option value="3"><span>★★★</span>有烘焙經驗比較好</option>
                    </select>
                </div>

                <div class="input_Box">
                    <label for="kind">種類</label>
                    <select id="kind" name="kind" class="select">
                        <option value="蛋糕">蛋糕</option>
                        <option value="點心">點心</option>
                    </select>
                </div>

                <div class="input_Box">
                    <label for="cSize">尺寸/數量</label>
                    <select id="cSize" name="cSize" class="select">
                        <option value="6吋">6吋</option>
                        <option value="12個">12個</option>
                    </select>
                </div>
            </div>

            <!-------------------------------------------------------------------------------->

            <div class="mid_Box">
                <div class="text_Box">
                    <label for="feature">產品簡介</label>
                    <textarea id="feature" name="feature" maxlength="200" placeholder="字數上限為200字"></textarea>
                </div>

                <div class="text_Box">
                    <label for="material">材料內容</label>
                    <textarea id="material" name="material" placeholder="字數上限為200字"></textarea>
                </div>
            </div>

            <div class="mid_Box">
                <div class="img_Box">
                    <label for="cImg1">上傳產品照片</label>
                    <img id="img1" src="../../image/defaultImg.jpeg" alt="未上傳圖片" />
                    <input accept="image/*" type="file" id="cImg1" name="cImg1" />
                    <!-- <span></span> -->
                </div>
                <div class="img_Box">
                    <img id="img2" src="../../image/defaultImg.jpeg" alt="未上傳圖片" />
                    <input accept="image/*" type="file" id="cImg2" name="cImg2" />
                    <!-- <span></span> -->
                </div>
            </div>

            <div style="width: 100%;">
                <center>
                    <input type="submit" value="確定新增" id="checked" />
                </center>
            </div>
        </form>
    </div>
</body>


<script>
    //第一張圖片預覽
    $("#cImg1").on("change", function (e) {
        const file = this.files[0]; //將上傳檔案轉換為base64字串

        const fr = new FileReader(); //建立FileReader物件
        fr.onload = function (e) {
            $("#img1").attr("src", e.target.result); //读取的结果放入圖片
        };
        // 使用 readAsDataURL 將圖片轉成 Base64
        fr.readAsDataURL(file);
        console.log('ok');


    });

    //第二張圖片預覽
    $("#cImg2").on("change", function (e) {
        const file = this.files[0]; //將上傳檔案轉換為base64字串

        const fr = new FileReader(); //建立FileReader物件
        fr.onload = function (e) {
            $("#img2").attr("src", e.target.result); //读取的结果放入圖片
        };
        // 使用 readAsDataURL 將圖片轉成 Base64
        fr.readAsDataURL(file);
        console.log('ok');
    });

    $(document).ready(function () {
        $("#add_form").on("submit", function (e) {
            e.preventDefault();
            dataString = jQuery('form#add_form').serialize();

            fetch(`/Cake/public/php/admin/add.php`, {
                method: "POST",
                body: new FormData(add_form)
            }).then(function (response) {
                return response.text();
            })
                .then(function (data) {
                    console.log(data);
                    Swal.fire({
                        title: "修改成功",
                        text: "3秒後自動跳轉產品頁面",
                        icon: "success",
                        confirmButtonText: "回到上一頁",
                    }).then(() => {
                        window.location = "mgt_product.php"
                    }).then(setTimeout(() => {
                        window.location = "mgt_product.php"
                    }, 3000))
                })
        // if(typeof(data) !== 'undefined'){
        //     reloadPage();
        // }
    })
        //   jQuery.ajax({
        //       type: "POST",
        //       url: "/Cake/public/php/admin/add.php",
        //       data: dataString,
        //       success:  function(data)
        //       {
        //         console.log(data);
        //         // Swal.fire({
        //         //   title: "修改成功",
        //         //   text: "3秒後自動跳轉產品頁面",
        //         //   icon: "success",
        //         //   confirmButtonText: "回到上一頁",
        //         // }).then( () => {
        //         //     window.location = "mgt_product.php"
        //         // }).then(setTimeout(() => {
        //         //     window.location = "mgt_product.php"
        //         // }, 3000))
        //       },
        //       error:  function(data)
        //       { 
        //         Swal.fire(
        //           "上傳失敗", //標題 
        //           "請重新上傳", //訊息內容(可省略)
        //           "error" //圖示 success/info/warning/error/question
        //         )
        //       }
        //   }); 
    });

    function re() {
        const pname = document.getElementById("pname");
        const price = document.getElementById("price");
        const feature = document.getElementById("feature");
        const material = document.getElementById("material");
        pname.value = "cakeprojectphpd05@gmail.com";
        price.value = "1";
        feature.value = "0912345678";
        material.value = "material";
    }
</script>