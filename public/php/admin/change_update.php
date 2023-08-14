<?php
require_once('../DB.php');
require_once('../db2.php');

$cName = $_REQUEST['cname'];
$level = $_REQUEST['level'];
$kind = $_REQUEST['kind'];
$cSize = $_REQUEST['cSize'];
$price = $_REQUEST['price'];
$feature = $_REQUEST['feature'];
$material = $_REQUEST['material'];
// $change = $_REQUEST['change_cName'];
$cImg1 = $_FILES['cImg1']['tmp_name'];
$cImg2 = $_FILES['cImg2']['tmp_name'];

if( isset($cImg1) and isset($cImg2)){
    move_uploaded_file($cImg1,"../../../image/cake_add/".$_FILES["cImg1"]["name"]);
    $c1 = "../../../image/cake_add/".$_FILES["cImg1"]["name"];
    // echo $c1 ."<br/>";
    move_uploaded_file($cImg2,"../../../image/cake_add/".$_FILES["cImg2"]["name"]);
    $c2 = "../../../image/cake_add/".$_FILES["cImg2"]["name"];
    // echo $c2;

    $sql="update cake set cName = ? ,price = ? ,kind = ? ,cSize = ? ,cImg1 = ? ,cImg2 = ? ,feature = ? ,level = ? ,material = ?  where cName = ?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('ssssssssss',$cName,$price,$kind,$cSize,$c1,$c2,$feature,$level,$material,$change);
    $stmt->execute();
}if(!isset($cImg1) and isset($cImg2)){
    move_uploaded_file($cImg2,"../../../image/cake_add/".$_FILES["cImg2"]["name"]);
    $c2 = "../../../image/cake_add/".$_FILES["cImg2"]["name"];
    // echo $c2;
    $sql="update cake set cName = ? ,price = ? ,kind = ? ,cSize = ?  ,cImg2 = ? ,feature = ? ,level = ? ,material = ?  where cName = ?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('sssssssss',$cName,$price,$kind,$cSize,$c2,$feature,$level,$material,$change);
    $stmt->execute();
}if(isset($cImg1) and !isset($cImg2)){
    move_uploaded_file($cImg1,"../../../image/cake_add/".$_FILES["cImg1"]["name"]);
    $c1 = "../../../image/cake_add/".$_FILES["cImg1"]["name"];
    echo $c1 ."<br/>";

    $sql="update cake set cName = ? ,price = ? ,kind = ? ,cSize = ? ,cImg1 = ?  ,feature = ? ,level = ? ,material = ?  where cName = ?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('sssssssss',$cName,$price,$kind,$cSize,$c1,$feature,$level,$material,$change);
    $stmt->execute();
}else{
    $sql="update cake set cName = ? ,price = ? ,kind = ? ,cSize = ?  ,feature = ? ,level = ? ,material = ?  where cName = ?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('ssssssss',$cName,$price,$kind,$cSize,$feature,$level,$material,$change);
    $stmt->execute();
}

header("refresh:2;url=../../CMS/mgt_product.php"); 
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<script src="//unpkg.com/layui@2.7.6/dist/layui.js"></script>
<script>
    //显示自动关闭倒计秒数

layer.alert('已修改成功，將自動跳轉', {icon: 6,
  time: 2*1000
  ,success: function(layero, index){
    var timeNum = this.time/1000, setText = function(start){
      layer.title((start ? timeNum : --timeNum) + ' 秒後跳轉', index);
    };
    setText(!0);
    this.timer = setInterval(setText, 1000);
    if(timeNum <= 0) clearInterval(this.timer);
  }
  ,end: function(){
    clearInterval(this.timer);
  }
});
</script>
</html> -->
