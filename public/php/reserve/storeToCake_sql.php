<?php
require('../BDB.php');
// DB::select('select * from userinfo where uid = ? or uid = ?', function($rows) {
//     foreach($rows as $row) {
//         echo "{$row['cname']}<br>";
//     }
// }, ['A01','A02', 10]);

$sid = $_REQUEST["sid"];

DB::select('select c.cid, c.cName, c.kind from cake c left join storeToCake s on s.cid = c.cid where s.sid = ?', function($rows){
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
},[$sid]);

// $photo = file_get_contents('tttt.jpg');
// DB::update('update userinfo set image = ? where uid = ?', [[$photo], 'A01']);
?>