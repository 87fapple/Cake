<?php
require_once('../db2.php');

$cid = $_GET['cid'];

$sql = "DELETE FROM cake WHERE cake.cid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $cid);
$stmt->execute();

header("refresh:2;url=../../CMS/mgt_product.php"); 
?>
<!DOCTYPE html>
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

layer.alert('刪除成功，將自動跳轉', {
  icon: 6,
  btn: ['確定'],
  time: 2*1000,
  success: function(layero, index){
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
</html>