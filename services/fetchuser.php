<?php
include '../config/db_config.php';

$output = [];
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
                    'password' => $row['MOT DE PASSE'],
                    'status' => $row['status'],
                    'Name' => $row['NOM'],
                    'role' => $row['role'],
                    'default_email' => $row['default_email'],
                    'gmail' => $row['gmail'],
                    'id'   => $row['N°'],
                );
             
        }
         echo json_encode($output);
    }
   
}




?>