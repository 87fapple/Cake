<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require_once('../DB.php');
DB::select('select * from store', function($rows){
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
});
?>