<?php
session_start();
require_once "../config/db_config.php";
//print_r($_POST);
if(isset($_POST['login']) && !empty($_POST['password']) && isset($_POST['uname']) && isset($_POST['role'])){
   
    $fieldArr['LOGIN']  = $login = (isset($_POST['login'])) ? $_POST['login'] : '';
    $fieldArr['MOT DE PASSE'] = (isset($_POST['password'])) ? $_POST['password'] : '';
    $fieldArr['NOM'] = (isset($_POST['uname'])) ? $_POST['uname'] : '';
    $fieldArr['role'] = (isset($_POST['role'])) ? $_POST['role'] : '';
    $fieldArr['default_email'] = $default_email = (isset($_POST['default_email'])) ? $_POST['default_email'] : '';
    $fieldArr['gmail'] = $gmail = (isset($_POST['gmail'])) ? $_POST['gmail'] : '';

     $id = (isset($_POST['id'])) ? $_POST['id'] : '';
  if(empty($id))
  {
    $sql = 'select * from users where (LOGIN = :LOGIN) or (gmail = :gmail) or (default_email = :default_email)';
    $stmt = $pdo->prepare($sql);
    $p = ['LOGIN'=>$login, 'default_email'=>$default_email, 'gmail'=>$gmail ];
    $stmt->execute($p);

    if($stmt->rowCount() == 0)
    { 
      $aff_id=$crud->create('users', $fieldArr);
      echo 'added';     
    }else{
        echo 'User Already Exist Error';
    }
  }else if(!empty($id)){

  $sql = "select * from users where (LOGIN = :LOGIN) and (N° != '".$id."')";
      $stmt = $pdo->prepare($sql);
      $p = ['LOGIN'=>$login];
      $stmt->execute($p);
    echo  $stmt->rowCount();

      print_r($stmt);
      if($stmt->rowCount() == 0)
      {
        if($crud->updateUsers('users', $fieldArr, $id)){
         echo 'updated';         
        }else{
          echo 'Error';
        }
      }else{
                echo 'User Already Exist Error';
      }
  }else {
    echo 'Error';
    } 
}