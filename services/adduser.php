<?php
session_start();
require_once "../config/db_config.php";
//print_r($_POST);
if(isset($_POST['login']) && !empty($_POST['password']) && isset($_POST['uname'])){
   
    $fieldArr['LOGIN']  = (isset($_POST['login'])) ? $_POST['login'] : '';
    $fieldArr['MOT DE PASSE'] = (isset($_POST['password'])) ? $_POST['password'] : '';
    $fieldArr['NOM'] = (isset($_POST['uname'])) ? $_POST['uname'] : '';


     $id = (isset($_POST['id'])) ? $_POST['id'] : '';
  if(empty($id))
        {
            $sql = 'select * from users where LOGIN = :LOGIN';
            $stmt = $pdo->prepare($sql);
            $p = ['LOGIN'=>$_POST['login']];
            $stmt->execute($p);

            if($stmt->rowCount() == 0)
            { 
              $aff_id=$crud->create('users', $fieldArr);
              echo 'added';
              

            }else{
                echo 'user Already Exist Error';
            }
        

  }else if(!empty($id)){
    if($crud->updateUsers('users', $fieldArr, $id)){
       echo 'updated';
     
    }else{
      echo 'Error';
    }
  }
}else {
  echo 'Error';
  } 