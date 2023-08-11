<?php session_start(); ?>
<?php
// if (!$_COOKIE['token']) {
//     header('Location: login.php');
//     die();
// }
require_once('../DB.php');
require_once('../db2.php');
// require_once('../image.php');

$cName = $_REQUEST['pname'];
$level = $_REQUEST['level'];
$kind = $_REQUEST['kind'];
$cSize = $_REQUEST['cSize'];
$price = $_REQUEST['price'];
$feature = $_REQUEST['feature'];
$material = $_REQUEST['material'];
$cImg1 = $_FILES['cImg1']['tmp_name'];
$cImg2 = $_FILES['cImg2']['tmp_name'];
// $c1=new Image($cImg1);
// $c1->resize(400,400,'fill');
// list($c1) = $photo->getImageSrc('thumb');

// $c1 = file_get_contents($c1);
// $c1 = base64_encode($c1);
// $c2 = file_get_contents($c2);

if ($_FILES["cImg1"]["error"] > 0 or $_FILES["cImg2"]["error"] > 0) {
    echo "Return Code: " . $_FILES["cImg1"]["error"] . "<br />";
    echo "Return Code: " . $_FILES["cImg2"]["error"] . "<br />";
    echo "圖片錯誤,3秒後自動跳轉";
} else {
    move_uploaded_file($cImg1,"../../../image/cake_add/".$_FILES["cImg1"]["name"]);
    $c1 = "../image/cake_add/".$_FILES["cImg1"]["name"];
    // echo $c1 ."<br/>";
    move_uploaded_file($cImg2,"../../../image/cake_add/".$_FILES["cImg2"]["name"]);
    $c2 = "../image/cake_add/".$_FILES["cImg2"]["name"];
    // echo $c2;
    echo "上傳成功,3秒後自動跳轉";
}


$sql="insert into cake(cName,price,kind,cSize,cImg1,cImg2,feature,level,material)
value(?,?,?,?,?,?,?,?,?)";
$stmt=$mysqli->prepare($sql);
$stmt->bind_param('sssssssss',$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$material);
// $stmt->send_long_data(4, $c1);
// $stmt->send_long_data(5, $c2);
$stmt->execute();


// DB::insert('insert into cake(cName,price,kind,cSize,cImg1,cImg2,feature,level,material)
// value(?,?,?,?,?,?,?,?,?)',[$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$material]);


//查看圖片內容
// if (($_FILES["cImg1"]["type"] == "image/gif")
// || ($_FILES["cImg1"]["type"] == "image/jpeg")
// || ($_FILES["cImg1"]["type"] == "image/jpg"))

// if ($_FILES["cImg1"]["error"] > 0) {
//     echo "Return Code: " . $_FILES["cImg1"]["error"] . "<br />";
// } else {
    // echo "檔名: " . $_FILES["cImg1"]["name"] . "<br />";
    // echo "檔案型別: " . $_FILES["cImg1"]["type"] . "<br />";
    // echo "檔案大小: " . ($_FILES["cImg1"]["size"] / 1024) . " Kb<br />";
    // echo "快取檔案: " . $_FILES["cImg1"]["tmp_name"] . "<br />";

    // if(file_exists("image/".$_FILES["cImg1"]["name"])){
    //     echo "檔案已經存在，請勿重複上傳";
    // }else{
    // move_uploaded_file($_FILES["cImg1"]["tmp_name"],"../image/".$_FILES["cImg1"]["name"]);
    // };
//     echo "image/".$_FILES["cImg1"]["name"];
// }

// header('location:/Cake/public/php/sign/add2.html');
header("refresh:2;url=add2.html"); 
// alert('正在加载，请稍等...3秒後自動跳轉');