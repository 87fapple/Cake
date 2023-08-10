<?php
require('php/db2.php');

$pwd=$_REQUEST['pwd'];

DB::update('update userinfo set pwd = ? where token')