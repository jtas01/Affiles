<?php
include '../config/db_config.php';

$output = [];
// $id= (isset($_POST['id']))?$_POST['id']:'';
$id= (isset($_GET['id']))?$_GET['id']:'';
if($id){
    $query = "SELECT * FROM users WHERE `id` =".$id;
}  else{
    $query = "SELECT * FROM users WHERE id = 5";
}
if($result = $pdo->query($query)){
    if($result->rowCount() > 0){
        while($row = $result->fetch()){
            $output[] = array(
                'id' => $row['id'],
                'uname' => $row['uname'],
                'email' => $row['email'],
                'message' => 'Success'
            );
        }
        echo json_encode($output);
    } else echo json_encode("No Data");
} else echo json_encode("Query error");


?>