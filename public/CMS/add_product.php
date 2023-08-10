<?php $title = 'CMS Add Product'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '新增品項'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>



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

	.box form .big_Box {
		width: 47%;
		margin: 0 4px;	
		display: flex;
		flex-wrap: wrap;
		flex-direction: column;
		justify-content: flex-start;		
		align-items: flex-start;
	}

	.box form .big_Box:nth-child(2) {
		position: relative;
	}

  .box form .text_Box {
		display: block;
		width: 50%;
		height: 56px;
	}

	.box form .text_Box label {
		display: inline-block;
		width: 110px;
	}

	.box form .text_Box input,
	.box form .text_Box select {
		width: 200px;
		height: 24px;
	}
	
	.text_Box textarea {
		width: 290px;
    height: 100px;
    resize: none;
    font-size: 0.5rem;
}


  #img1:after,
  #img2:after{
    content: "\f1c5" " "attr(alt) ;
  
    font-size: 16px;
    font-family: FontAwesome;
    color: rgb(100, 100, 100);
  
    display: block;
    position: relative;
    z-index: 2;
    top: -27px;
    left: 0;
    width: 110px;
    height: 25px;
    background-color: #fff;
  }
</style>

<body>
  <div class="container box" id="changeForm">
    <h2>新增產品資訊</h2>

    <form action="../php/admin/add.php" method="post" enctype="multipart/form-data">
      <div class="big_Box">
        <div class="text_Box">
          <label for="pname">產品名稱</label>
          <input type="text" id="pname" name="pname"
            placeholder="請輸入產品名稱" required />
        </div>

				<div class="text_Box">
					<label for="price">產品價格</label>
					<input type="number" id="price" name="price" step="10"
					placeholder="請輸入價格" required />
				</div>

        <div class="text_Box">
          <label for="level">難度</label>      
          <select name="level" id="level" class="select">
            <option value="1"><span>★</span>小朋友都會</option>
            <option value="2"><span>★★</span>適合大人初學者</option>
            <option value="3"><span>★★★</span>有烘焙經驗比較好</option>
          </select>          
        </div>

        <div class="text_Box">
          <label for="kind">種類</label>
          <select id="kind" name="kind" class="select">
						<option value="蛋糕">蛋糕</option>
						<option value="點心">點心</option>
          </select>
        </div>

				<div class="text_Box">
					<label for="cSize">尺寸/數量</label>
					<select id="cSize" name="cSize" class="select">
						<option value="6吋">6吋</option>
						<option value="12個">12個</option>
					</select>
				</div>
			</div>
				

			<div class="big_Box">
				<div class="text_Box">
					<label for="feature">產品簡介</label>
					<textarea
					id="feature"
					name="feature"
					maxlength="200"
					placeholder="字數上限為200字"></textarea>
				</div>
				
				<div class="text_Box" style="margin-top:100px">
					<label for="material">材料內容</label>
					<textarea
					id="material"
					name="material"
					placeholder="字數上限為200字"></textarea>
				</div>
	
				<div class="img_Box">
					<label for="cImg1">上傳產品照片</label>
					<div>
						<input accept="image/*" type="file" id="cImg1" name="cImg1" />
						<img id="img1" src=""  style="max-width: 200px" alt="未上傳圖片"/>
					</div>
					<div>
						<input type="file" id="cImg2" name="cImg2" />
						<img id="img2" src=""  style="max-width: 200px" alt="未上傳圖片"/>
					</div>
				</div>
			</div>
				
			<input type="submit" value="確定新增" id="checked"/>
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
</script>
