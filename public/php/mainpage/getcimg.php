<?php
require('../db2.php');

$sql = "SELECT Img1, Img2, Img3, Img4 FROM binfo WHERE act = 1";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// 建立一個陣列來儲存圖片資料
$images = array();

// 將查詢結果轉換成 base64 編碼的圖片資料
while ($row = $result->fetch_assoc()) {
    $imageData1 = base64_encode($row['Img1']);
    $imageData2 = base64_encode($row['Img2']);
    $imageData3 = base64_encode($row['Img3']);
    $imageData4 = base64_encode($row['Img4']);

    // 將圖片欄位的資料存入陣列中
    array_push($images, $imageData1, $imageData2, $imageData3, $imageData4);
}

// 輸出 JSON 格式的圖片資料
header('Content-Type: application/json');
echo json_encode($images);
?>
