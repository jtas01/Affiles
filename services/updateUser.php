<?php
include '../config/db_config.php';

$output = [];

if (isset($_POST['id'])){
    $id= trim($_POST['id']);
    $name = ($_POST['name'])?trim($_POST['name']):'';
    $email = ($_POST['name'])?trim($_POST['name']):'';

    // $query = "UPDATE users SET WHERE `id` =".$id;


    $output = "Update Successful : id = ".$id;

} else $output = 'Update Error: No Id found.';


echo json_encode($output);
?>