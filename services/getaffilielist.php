<?php
require_once "../config/db_config.php";
if(isset($_POST['id'])){
    $id=$_POST['id'];
}else{
    $id='';
}
echo selectAllRecords($pdo, 'affilie', $id);
function selectAllRecords($pdo, $tablename, $id){
    $members = [];
    $j = 0;

        if($id){
        $query = "SELECT * FROM affilie WHERE `Clé Affilié` =".$id;
    }  else{
        $query = "SELECT * FROM affilie";
    }
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