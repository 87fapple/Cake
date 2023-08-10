<?php
header('Refresh:3,url=/Cake/public/login.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//unpkg.com/layui@2.7.6/dist/layui.js"></script>
</head>
<body>
    <script>
        layer.open({
        content: '修改完成,3秒後跳轉...',
        title:(''),
        scrollbar: false
});
    </script>
</body>
</html>