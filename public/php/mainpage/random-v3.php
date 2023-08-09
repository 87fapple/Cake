<?php
require('../db2.php');

$randomData = array();

for ($i = 1; $i <= 3; $i++) {
    $sql = "SELECT e.*, u.uName FROM exp AS e
    JOIN userinfo AS u ON e.uid = u.uid
    ORDER BY RAND() LIMIT 1";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $randomData[] = $row;
    }
}

echo json_encode($randomData);
?>