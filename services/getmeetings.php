<?php
require_once "../config/db_config.php";


    echo selectAllRecords($pdo, 'meeting');

function selectAllRecords($pdo, $tablename){
    $members = [];
    $j = 0;

    $query = "SELECT * FROM $tablename";
    $result =  $pdo->query($query);
    $count=$result->rowCount();
    if($count>0) {
        while ($row = $result->fetch()) {
            $members[$j] = $row;
            $j++;
        }
         return json_encode($members);
    }else{
        echo 'No data found';
    }
}
   





?>