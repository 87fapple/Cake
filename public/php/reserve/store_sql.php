<?php
require('../BDB.php');
DB::select('select * from store', function($rows){
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
});
?>