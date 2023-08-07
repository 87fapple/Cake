<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require_once('../DB.php');

$indexInfo = $_REQUEST["indexInfo"];
// var_dump($_REQUEST);

DB::select('select c.cid, c.cName, c.kind from cake c left join storetocake s on s.cid = c.cid where s.sid = ?', function($rows){
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
},[$indexInfo]);



?>