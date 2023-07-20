<?php
require('../BDB.php');
// DB::select('select * from userinfo where uid = ? or uid = ?', function($rows) {
//     foreach($rows as $row) {
//         echo "{$row['cname']}<br>";
//     }
// }, ['A01','A02', 10]);

DB::select('select * from store', function($rows){
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
});

// $photo = file_get_contents('tttt.jpg');
// DB::update('update userinfo set image = ? where uid = ?', [[$photo], 'A01']);
?>