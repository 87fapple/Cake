<?php
require("../DB.php");
// var_dump($_REQUEST);

$cid = $_REQUEST["cid"];

DB::select("select e.eid, u.uName, e.eText, e.eDate from exp e join userinfo u on u.uid = e.uid where cid = ?", function($rows){
    echo json_encode($rows);
},[$cid]);

?>