<?php
session_start();
require_once "../config/db_config.php";
if(isset($_POST['nom']) && !empty($_POST['affid']) && isset($_POST['email']) && !empty($_POST['email'])){
    $fieldArr['ID_Affiliés']  = (isset($_POST['affid'])) ? $_POST['affid'] : '';
     $id  = (isset($_POST['cids'])) ? $_POST['cids'] : '';
    $fieldArr['Type']  = (isset($_POST['type'])) ? $_POST['type'] : '';
    $fieldArr['Nom'] = (isset($_POST['nom'])) ? $_POST['nom'] : '';
    $fieldArr['Prénom'] = (isset($_POST['prenom'])) ? $_POST['prenom'] : '';
    $fieldArr['Tél'] = (isset($_POST['telephone'])) ? $_POST['telephone'] : '';
    $fieldArr['Gsm'] = (isset($_POST['gsm'])) ? $_POST['gsm'] : '';
    $fieldArr['Email'] = (isset($_POST['email'])) ? $_POST['email'] : '';
  if(empty($id)){
     if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $sql = 'select * from affiliés_contacts where Email = :Email';
            $stmt = $pdo->prepare($sql);
            $p = ['Email'=>$_POST['email']];
            $stmt->execute($p);

            if($stmt->rowCount() == 0)
            { 
              if($crud->create('affiliés_contacts', $fieldArr)){
                 echo 'added';
              }
            }else{
              echo 'Email Already Exist Error';
            }
        }

  }else if(!empty($id)){
    if($crud->updateContact('affiliés_contacts', $fieldArr, $id)){
      echo 'updated';
    }else{
      echo 'Error';
    }
  }

       
   
    
}else {
  echo 'Error';
  } 