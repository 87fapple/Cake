<?php
require('../db2.php');

$bid = $_REQUEST['bid'];
$body = $_REQUEST['body'];

// 定義要處理的檔案數量
$fileCount = 5;

// 逐一處理每個檔案上傳
for ($i = 1; $i <= $fileCount; $i++) {
    $fileKey = 'file' . $i;
    $src = $_FILES[$fileKey]['tmp_name'];

    // 檢查是否有選擇上傳檔案
    if (!empty($src)) {
        $contents = file_get_contents($src);
        $stmt = $mysqli->prepare("UPDATE binfo SET Img{$i} = ? WHERE bid = ?");
        $stmt->bind_param('bs', $contents, $bid);
        $stmt->send_long_data(0, $contents); // 使用 send_long_data 進行大型資料傳輸
        $stmt->execute();
    }
}

// 更新文字內容
$stmt = $mysqli->prepare("UPDATE binfo SET body = ? WHERE bid = ?");
$stmt->bind_param('si', $body, $bid);
$stmt->execute();

echo "修改成功!";
sleep(5);

// 刪除暫存檔案
for ($i = 1; $i <= $fileCount; $i++) {
    $fileKey = 'file' . $i;
    $src = $_FILES[$fileKey]['tmp_name'];
    if (!empty($src)) {
        unlink($src);
    }
}
?>