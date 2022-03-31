<?php
include '../config/db_config.php';

$output = [];
// $id= (isset($_POST['id']))?$_POST['id']:'';
$id= (isset($_GET['id']))?$_GET['id']:'';
if($id){
    $query = "SELECT * FROM users WHERE `N°` =".$id;
}  else{
    $query = "SELECT * FROM users";
}
if($result = $pdo->query($query)){
    if($result->rowCount() > 0){
        while($row = $result->fetch()){
            $output[] = array(
                    
                    'Login' => $row['LOGIN'],
                    // 'Password' => $row['MOT DE PASSE'],
                    'Name' => $row['NOM'],
                    'id'   => $row['N°'],
                );
             
        }
         echo json_encode($output);
    }
   
}




?>