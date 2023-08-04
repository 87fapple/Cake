<?php
require('../db2.php');

$bid = $_REQUEST['bid'];
// $text = $_REQUEST['text'];
$src = $_FILES['file1']['tmp_name'];
$src1 = $_FILES['file2']['tmp_name'];
$src2 = $_FILES['file3']['tmp_name'];
$src3 = $_FILES['file4']['tmp_name'];
$src4 = $_FILES['file5']['tmp_name'];
$contents = file_get_contents($src);
$contents1 = file_get_contents($src1);
$contents2 = file_get_contents($src2);
$contents3 = file_get_contents($src3);
$contents4 = file_get_contents($src4);

$sql = "update binfo set Img1 = ?,Img2 = ?,Img3 = ?,Img4 = ?,bodyimg = ? where bid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('bbbbbs', $contents, $contents1, $contents2, $contents3, $contents4, $bid);
$stmt->send_long_data(0, $contents); // send_long_data(a, 變數) a取至於上方的相對位置 (bs) [01]
$stmt->send_long_data(1, $contents1); // send_long_data(a, 變數) a取至於上方的相對位置 (bs) [01]
$stmt->send_long_data(2, $contents2); // send_long_data(a, 變數) a取至於上方的相對位置 (bs) [01]
$stmt->send_long_data(3, $contents3); // send_long_data(a, 變數) a取至於上方的相對位置 (bs) [01]
$stmt->send_long_data(4, $contents4); // send_long_data(a, 變數) a取至於上方的相對位置 (bs) [01]

$stmt->execute();

echo "真的修改成功!";
sleep(5);

unlink($src);