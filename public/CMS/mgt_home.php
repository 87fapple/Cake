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
    margin: 32px 2.5%;
    border: 2px solid #885500;
    border-radius: 12px;
  }

  .container h2,
  .container div {
    margin: 32px;
  }

  .container div {
    display: flex;
  }
</style>

<body>
  <div class="container box">
    <h2>圖片群組</h2>
    <div>
      <button onclick="loadImagesWithAjax(1)">Group 1</button>
      <button onclick="loadImagesWithAjax(2)">Group 2</button>
      <button onclick="loadImagesWithAjax(3)">Group 3</button>
      <button onclick="loadImagesWithAjax(4)">Group 4</button>
    </div>
    
    <form id="imageForm" data-bid="">
      <!-- 初始載入頁面時的表單內容 -->
      <input type="file" name="file1" onchange="updateImagePreview(1)" />
      <img src="" alt="" />
      <input type="file" name="file2" onchange="updateImagePreview(2)" />
      <img src="" alt="" />
      <input type="file" name="file3" onchange="updateImagePreview(3)" />
      <img src="" alt="" />
      <input type="file" name="file4" onchange="updateImagePreview(4)" />
      <img src="" alt="" />

      <hr>
      <input type="file" name="file5" onchange="updateImagePreview(5)" />
      <img src="" alt="" />
      <textarea name="body" rows="4" cols="50"></textarea>
      <button type="button" onclick="submitForm()">上傳</button>
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
    xhr.open("GET", `./previmg.php?bid=${bid}`, true);
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
    const imgElement = document.querySelectorAll("img")[inputIndex - 1];

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
    xhr.open("POST", `./upload.php?bid=${bid}`, true);
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