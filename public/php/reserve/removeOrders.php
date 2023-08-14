<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: /Cake/public/login.html');
    die();
}
require_once('../DB.php');

$oToken = $_GET["oToken"];
if(isset($oToken)){
    DB::update('update orders set remove = 1 where oToken = ?',[$oToken]);

    DB::select('select remove from orders where oToken = ?',function($rows){
        // var_dump($rows);
        if($rows[0]['remove'] === 1){
            echo "success";
        }else{
            echo "fail";
        }
    },[$oToken]);
}
?>