<?php
require('../db2.php');

// 從表單中獲取所選的選項
$selectbid = $_POST['bid'];

// 更新資料庫中的資料
$sqlUpdateAll = "UPDATE binfo SET act = 0"; // 先將所有記錄的act設為0
$stmtUpdateAll = $mysqli->prepare($sqlUpdateAll);
$stmtUpdateAll->execute();

$sqlUpdateSelected = "UPDATE binfo SET act = 1 WHERE bid = ?"; // 將所選選項的act設為1
$stmtUpdateSelected = $mysqli->prepare($sqlUpdateSelected);
$stmtUpdateSelected->bind_param("i", $selectbid);
$stmtUpdateSelected->execute();

$stmtUpdateAll->close();
$stmtUpdateSelected->close();

header("Location: ../../../public/test2.html");
exit();
?>
