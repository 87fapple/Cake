<?php
    require('../db2.php');

    $sql = 'select * from cake';
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()){
        echo 
            "
            <div class=\"menuInfoDiv\" id=\"menuInfo\">
                <a href=\"\"><img src=\"/Cake/image/menuImg/menuInfo1.jpg\"></a>
                <div class=\"menuInfoContent\" id=\"menuInfoContent\">
                    <ul class=\"menuInfo\" id=\"menuInfo\">
                        <li>名稱：{$row['cName']}</li>
                        <li>時間：2hr</li>
                        <li>難度：{$row['level']}</li>
                        <li>價格：{$row['price']}</li>
                    </ul>
                </div>
            </div>
            ";
    }
?>