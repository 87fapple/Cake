<?php
require_once('../BDB.php');

// $sid = $_REQUEST["location"];
// $peopleNum = $_REQUEST["peopleNum"];
// $fDate = $_REQUEST["fDate"];

// var_dump($_REQUEST);

if (!isset($_REQUEST["location"])){
    echo "資料有空";
}