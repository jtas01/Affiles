<?php
require_once "../config/db_config.php";
 $id=$_POST['id'];
if(isset($_POST['id'])){
    echo selectAllRecords($pdo, 'affiliés_contacts', $id);
}

function selectAllRecords($pdo, $tablename, $id){
    $members = [];
    $j = 0;

    $query = "SELECT * FROM $tablename  WHERE `ID_Affiliés` =".$id;
    $result =  $pdo->query($query);
    $count=$result->rowCount();
    if($count>0) {
        while ($row = $result->fetch()) {
           $response[]=array(
 
                    'cids' => $row['N°'],
                    'cle_id' => $row['ID_Affiliés'],
                    'Type' => $row['Type'],
                    'nom' => $row['Nom'],
                    'prenom' => $row['Prénom'],
                    'tele' => $row['Tél'],
                    'Gsm' => $row['Gsm'],
                     'Email' => $row['Email']
                );
        }
         return json_encode($response);
    }else{
        echo 'No data found';
    }
}
   





?>