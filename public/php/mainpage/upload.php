<?php
require_once('../DB.php');

?>
<?php
// 指定存儲上傳檔案的目錄為 binfo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $targetDir = "binfo/";

    // 取得表單欄位值
    $bid = $_POST["bid"];
    $description = $_POST["description"];

    // 上傳 5 張圖片
    $uploadedFiles = array();
    $uploadOk = 1;

    foreach ($_FILES["fileToUpload"]["tmp_name"] as $key => $tmp_name) {
        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"][$key], PATHINFO_EXTENSION));
        $uniqueFileName = uniqid() . '.' . $imageFileType; // 生成唯一的檔案名稱

        $targetFile = $targetDir . $uniqueFileName;

        // 檢查檔案是否為圖片檔案
        $check = getimagesize($tmp_name);
        if ($check === false) {
            echo "檔案不是一個圖片。";
            $uploadOk = 0;
        }

        // 允許指定的檔案格式
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "抱歉，只允許上傳 JPG, JPEG, PNG 和 GIF 檔案。";
            $uploadOk = 0;
        }

        // 檢查檔案大小限制，設定為 5 MB
        if ($_FILES["fileToUpload"]["size"][$key] > 5000000) {
            echo "抱歉，檔案太大。";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "抱歉，您的檔案未被上傳。";
        } else {
            if (move_uploaded_file($tmp_name, $targetFile)) {
                $uploadedFiles[] = $targetFile;
            } else {
                echo "抱歉，上傳檔案時發生錯誤。";
            }
        }
    }

    // 如果所有圖片都成功上傳，可以將其資訊存入資料庫
    if ($uploadOk == 1 && count($uploadedFiles) === 5) {

        // 將圖片路徑組合為一個字串，以逗號分隔
        $imagePaths = implode(",", $uploadedFiles);

        // 存入資料庫
        $query = "INSERT INTO your_table_name (bid, body, Img1, Img2, Img3, Img4, bodyImg) 
                  VALUES ('$bid', '$description', '$imagePaths', '$imagePaths', '$imagePaths', '$imagePaths', '$imagePaths')";

        echo "所有檔案已成功上傳並存入資料庫。";
    }
}
?>
