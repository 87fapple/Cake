<?php $title = 'CMS Modify Product'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '修改品項'; ?>
<?php include_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>
<?php 
require('../php/db2.php');
// require('../DB.php');


$uid = $_GET['uid'];
echo $cid;
$sql = "select uName,email,pwd,phone from userinfo where uid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $uid);
$stmt->execute();
$result = $stmt->get_result();
$row =$result->fetch_assoc();
?>



<!-- <link rel="stylesheet" href="./CMS_css/add_product.css"/> -->

<!-- icon引用 -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
<script src="https://kit.fontawesome.com/6c4c2bf9f6.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<!-- sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css" rel="stylesheet">


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


    .box form div input[type="submit"] {
        width: 80px;
        margin-top: 16px;
        padding: 4px;
        border: 2px solid #ffa237;
        border-radius: 6px;
        background-color: #ffa237;
    }

    .box form div input[type="submit"]:hover {
        border: 2px solid #ffbf00;
        background-color: #ffbf00;
    }

    #img1:after,
    #img2:after{
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
        <h2>修改會員資訊</h2>

        <form id="change_form" method="post" enctype="multipart/form-data">
        <!-- action="../php/admin/change_update.php"  -->
        <div class="container">

          <div class="scd-container">
            <hr />
            <span style="color: red">*</span>
            <label for="email"><b>電子信箱</b></label>
            <input
              type="text"
              placeholder="請輸入電子信箱"
              name="email"
              id="email"
              value="<?=$row['email']?>"
              required
            />
            <span style="color: red">*</span>
            <label for="text"><b>會員暱稱</b></label>
            <input
              type="text"
              placeholder="請輸入會員暱稱"
              name="uname"
              id="uname"
              value="<?= $row['uName']?>"
              required
            />
            <span style="color: red">*</span>
            <label for="phone"><b>手機號碼</b></label>
            <input
              type="phone"
              placeholder="請輸入手機號碼"
              name="phone"
              id="phone"
              value="<?=$row['phone'] ?>"
              required
            />
          </div>

          <button
            id="submit"
            type="submit"
            class="signupbtn"
            onclick="checkpwd()"
          >
            註冊
          </button>
        </div>
      </form>
    </div>
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

    $(document).ready(function(){
        $("#change_form").on("submit", function(e){
        e.preventDefault();
        dataString = jQuery('form#change_form').serialize();
        jQuery.ajax({
            type: "POST",
            url: "/Cake/public/php/admin/change_update.php",
            data: dataString,
            success:  function(data)
            { 
                Swal.fire({
                    title: "修改成功",
                    text: "3秒後自動跳轉產品頁面",
                    icon: "success",
                    confirmButtonText: "回到上一頁",
                }).then( () => {
                    window.location = "mgt_product.php"
                }).then(setTimeout(() => {
                    window.location = "mgt_product.php"
                }, 3000))
            }
      }); 
  });
});
</script>
