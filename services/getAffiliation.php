<?php
require_once "../config/db_config.php";
 $id=$_POST['id'];
if(isset($_POST['id'])){
   echo selectAllRecords($pdo, 'affiliations', $id);
    
}
function selectAllRecords($pdo, $tablename, $id){
    $members = [];
    $j = 0;
    $query = "SELECT * FROM $tablename as t1 INNER join affilie as t2 ON t1.`Clé Affilié`= t2.`Clé_Affilié`  WHERE t1.`Clé Affilié` =".$id;
    $result =  $pdo->query($query);
    $count=$result->rowCount();
    if($count>0) {
        while ($row = $result->fetch()) {
             $response[]=array(
                    'nom_affilie' => $row['Nom_Affilié'],
                    'cle_id' => $row['Clé Affilié'],
                    'affid' => $row['Clé Affiliation'],
                    'anne_year' => $row['Année Affiliation'],
                    'date_affilie' => $row['Date Affiliation'],
                    'montant' => $row['Montant'],
                    'type_affiliation' => $row['Clé type affiliation'],
                    'mode_payment' => $row['Mode de paiement'],
                    'paid_by' => $row['Payé par']
                );
        }
         return json_encode($response);
    }
}





?>