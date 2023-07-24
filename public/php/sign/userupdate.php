<?php session_start(); ?>
<?php
if (!$_COOKIE['token']) {
    header('Location: login.php');
    die();
}