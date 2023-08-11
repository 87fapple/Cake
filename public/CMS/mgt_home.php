<?php $title = 'CMS Home Management'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = '首頁管理'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>
<?php require_once(__DIR__ . '/navbar.php'); ?>

<style>
  .container {
    width: calc(100% - 200px);
    position: relative;
    top: 52px;
    left: 200px;
  }

  .box {
    width: calc(95% - 200px);
    margin: 32px 2.5% 72px;
    border: 2px solid #885500;
    border-radius: 12px;
  }

  .container h2,
  .container h3 {
    margin: 32px;
  }

  .groupForm {
    margin: 12px 42px;
  }

  .groupForm label {
    margin: 0 12px;
    }

  .groupForm label:hover,
  .groupForm input:hover {
    cursor: pointer;
  }

  .groupSelect,
  .container button {
    width: 72px;
    height: 36px;
    background-color: #ffa237;
    border: 1px solid #ffa237;
    border-radius: 6px;
  }

  .groupSelect {
    margin-top: 16px;
  }

  .groupSelect:hover,
  .container button:hover {
    background-color: #ffcb53;
    border: 1px solid #ffcb53;
    cursor: pointer;
  }

  .container .btnGroup {
    display: flex;
    margin: 12px 42px;
  }

  .container .btnGroup button {
    margin: 0 8px;
  }

  .imgCarousel {
    display: flex;
    flex-wrap: wrap;
    margin: 8px;
  }

  .card {
    width: 200px;
    height: 180px;
    margin: 8px 20px;
  }

  .card img {
    width: 200px;
    height: 150px;
  }

  .card input:hover {
    cursor: pointer;
  }

  .recommend {
    display: flex;
    align-items: center;
  }

  .recommend textarea {
    width: 200px;
    height: 150px;
  }
  
  .submitBtn {
    margin: 16px auto;
    text-wrap: none;
  }
</style>

<body>
  <div class="container box">
    <h2>選擇首頁輪播圖群組</h2>
    <form class="groupForm" action="/Cake/public/php/mainpage/changeact.php" method="post">
      <label><input type="radio" name="bid" value="1" />春</label>  
      <label><input type="radio" name="bid" value="2" />夏</label>
      <label><input type="radio" name="bid" value="3" />秋</label>
      <label><input type="radio" name="bid" value="4" />冬</label><br>
      <input class="groupSelect" type="submit" value="設定" />
    </form>
    <hr>

    <h2>上傳圖片</h2>
    <div class="btnGroup">
      <button onclick="loadImagesWithAjax(1)">春</button>
      <button onclick="loadImagesWithAjax(2)">夏</button>
      <button onclick="loadImagesWithAjax(3)">秋</button>
      <button onclick="loadImagesWithAjax(4)">冬</button>
    </div>
    
    <form id="imageForm" data-bid="">
      <h3>首頁輪播圖</h3>
      <!-- 初始載入頁面時的表單內容 -->
      <div class="imgCarousel">
        <div class="card">
          <img  src="../../image/defaultImg.jpeg" alt="圖片預覽" />
          <input type="file" name="file1" onchange="updateImagePreview(1)" />
        </div>
        <div class="card">
          <img  src="../../image/defaultImg.jpeg" alt="圖片預覽" />
          <input type="file" name="file2" onchange="updateImagePreview(2)" />
        </div>
        <div class="card">
          <img  src="../../image/defaultImg.jpeg" alt="圖片預覽" />
          <input type="file" name="file3" onchange="updateImagePreview(3)" />
        </div>
        <div class="card">
          <img  src="../../image/defaultImg.jpeg" alt="圖片預覽" />
          <input type="file" name="file4" onchange="updateImagePreview(4)" />
        </div>
      </div>

      <h3>近期推薦</h3>
      <div class="recommend">
        <div class="card">
          <img src="../../image/defaultImg.jpeg" alt="圖片預覽" />
          <input type="file" name="file5" onchange="updateImagePreview(5)" />
        </div>
        <textarea style="width:300px;height:180px;" placeholder="請輸入推薦內文" name="body" rows="4" cols="50"></textarea>
      </div>
        <center>
          <button class="submitBtn" type="button" onclick="submitForm()">上傳圖片</button>
        </center>
    </form>
  </div>
</body>
  
  <script>
    const form = document.getElementById("imageForm");
    let bid = form.dataset.bid; // 使用 dataset 屬性取得 data-bid 的值
    // console.log(bid);
    function loadImagesWithAjax(bid) {
      form.setAttribute("data-bid", bid);
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/Cake/public/php/mainpage/previmg.php?bid=${bid}`, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const images = JSON.parse(xhr.responseText);
          const imgElements = document.querySelectorAll("img");

          for (let i = 0; i < images.length; i++) {
            imgElements[i].src = `data:image/jpeg;base64,${images[i]}`;
          }
        } else {
          console.error("Error:", xhr.status, xhr.statusText);
        }
      }
    };
    xhr.send();
  }

  function updateImagePreview(inputIndex) {
    const inputElement = document.getElementsByName(`file${inputIndex}`)[0];
    const imgElement = document.querySelectorAll("img")[inputIndex -   1];

    if (inputElement.files && inputElement.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imgElement.src = e.target.result;
      };
      reader.readAsDataURL(inputElement.files[0]);
    }
  }

  function submitForm() {
    const formData = new FormData(form);
    const xhr = new XMLHttpRequest();
    let bid = form.dataset.bid;
    xhr.open("POST", `../php/mainpage/upload.php?bid=${bid}`, true);
    console.log(bid);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          console.log("Upload successful");
        } else {
          console.error("Error:", xhr.status, xhr.statusText);
        }
      }
    };
    xhr.send(formData);
  }

  // 新的 changeFormContent 函式，直接將修改加入到您的原始 <script> 區塊中
  function changeFormContent(bid) {
    const form = document.getElementById("imageForm");
    form.dataset.bid = bid; // 使用 dataset 屬性更新 data-bid 的值

    const formInputs = form.querySelectorAll("input[type='file']");
    const imgElements = form.querySelectorAll("img");

    for (let i = 0; i < formInputs.length; i++) {
      imgElements[i].src = ""; // 清空圖片預覽
    }

    loadImagesWithAjax(bid);
  }
</script>