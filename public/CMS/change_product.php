<?php $title = 'CMS Add Product'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '新增品項'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>
<?php 
require('../php/db2.php');
// require('../DB.php');


$cid = $_GET['cid'];
echo $cid;
$sql = "select cName,price,kind,cSize,feature,level,material, cImg1,cImg2 from cake where cid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $cid);
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
        border: 2px solid #fff5d6c4;
        background-color: #fff5d6c4;
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
        <h2>修改產品資訊</h2>

        <form action="../php/admin/change_update.php" method="post" enctype="multipart/form-data">
            <div class="mid_Box">

                <div class="input_Box">
                    <label for="pname">產品名稱</label>
                    <input type="text" id="cname" name="cname" placeholder="請輸入產品名稱"value="<?= $row['cName'] ?>" required />
                </div>

                <div class="input_Box">
                    <label for="price">產品價格</label>
                    <input type="number" id="price" name="price" step="10" placeholder="請輸入價格" value="<?= $row['price'] ?>" required />
                </div>

                <div class="input_Box">
                    <label for="level">難度</label>
                    <select name="level" id="level" class="select">
                        <?php 
                        if($row['level']==1){
                            echo '<option value="1"><span>★</span>小朋友都會</option>';
                        }if($row['level'==2]){
                            echo '<option value="2"><span>★★</span>適合大人初學者</option>';
                        }else{
                            echo '<option value="3"><span>★★★</span>有烘焙經驗比較好</option>';
                        }
                        ?>
                        <option value="1"><span>★</span>小朋友都會</option>
                        <option value="2"><span>★★</span>適合大人初學者</option>
                        <option value="3"><span>★★★</span>有烘焙經驗比較好</option>
                    </select>
                </div>

                <div class="input_Box">
                    <label for="kind">種類</label>
                    <select id="kind" name="kind" class="select">
                    <option value="<?= $row['kind'] ?>"><?= $row['kind'] ?></option>
                        <option value="蛋糕">蛋糕</option>
                        <option value="點心">點心</option>
                    </select>
                </div>

                <div class="input_Box">
                    <label for="cSize">尺寸/數量</label>
                    <select id="cSize" name="cSize" class="select">
                        <option value="<?= $row['cSize'] ?>"><?= $row['cSize'] ?></option>
                        <option value="6吋">6吋</option>
                        <option value="12個">12個</option>
                    </select>
                </div>
            </div>

            <!-------------------------------------------------------------------------------->

            <div class="mid_Box">
                <div class="text_Box">
                    <label for="feature">產品簡介</label>
                    <textarea id="feature" name="feature" maxlength="200"  placeholder="字數上限為200字"><?= $row['feature'] ?></textarea>
                </div>

                <div class="text_Box">
                    <label for="material">材料內容</label>
                    <textarea id="material" name="material" placeholder="字數上限為200字"><?= $row['material'] ?></textarea>
                </div>
            </div>

            <div class="mid_Box">
                <label for="cImg1">上傳產品照片</label>
                <div class="img_Box">
                    <input accept="image/*" type="file" id="cImg1" name="cImg1" />
                    <img id="img1" src="../<?= $row['cImg1']?>" style="max-width: 160px; max-height:123px " alt="未上傳圖片" />
                    <span></span>
                </div>
                <div class="img_Box">
                    <input type="file" id="cImg2" name="cImg2" />
                    <img id="img2" src="../<?= $row['cImg2']?>" style="max-width: 160px; max-height:130px" alt="未上傳圖片" />
                    <span></span>
                </div>
            </div>

            <div style="width: 100%;">
                <center>
                    <input type="submit" value="確定修改" id="checked" />
                </center>
            </div>
        </form>
    </div>
</body>

<script>
    const Name = document.getElementById("cName");

    change_cName.onchange = function (e){
        const cName = e.target.value;
        const data = {cName};
        fetch(
            `change_search.php?cName=${cName}`
        )
        .then(function(response){
            return response.json();
        })
        .then(function(data){
          console.log(data);
           Name.value = data[0].cName;
           price.value = data[0].price;
           cSize.value = data[0].cSize
           kind.value = data[0].kind;
           feature.value = data[0].feature;
           level.value = data[0].level;
           material.value = data[0].material;       
             img1.src=data[0].cImg1;       
             img2.src=data[0].cImg2;
           
        })
    }
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
</script>
