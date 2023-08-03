<?php
require_once('../DB.php');

$indexInfo = $_REQUEST["indexInfo"];

DB::select('select c.cid, c.cName, c.kind from cake c left join storetocake s on s.cid = c.cid where s.sid = ?', function($rows){
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
},[$sid]);



?>