<?php
session_start();
require_once "../config/db_config.php";
 if($_POST['cle_id'] && $_POST['anne_year']!='' && $_POST['montant']!='' && $_POST['mode_payment']!='' ){
    $fieldArr2['Année Affiliation']  = (isset($_POST['anne_year'])) ? $_POST['anne_year'] : '';
    $fieldArr2['Date Affiliation'] = (isset($_POST['date_affilie'])) ? $_POST['date_affilie'] : '';
    $fieldArr2['Montant'] = (isset($_POST['montant'])) ? $_POST['montant'] : '';
    $fieldArr2['Clé type affiliation'] = (isset($_POST['type_affiliation'])) ? $_POST['type_affiliation'] : '';
    $fieldArr2['Mode de paiement'] = (isset($_POST['mode_payment'])) ? $_POST['mode_payment'] : '';
    $fieldArr2['Payé par'] = (isset($_POST['paid_by'])) ? $_POST['paid_by'] : '';
    $fieldArr2['Clé Affilié'] = (isset($_POST['cle_id'])) ? $_POST['cle_id'] : '';
    $id= $_POST['affid'];
    if(empty($id)){

                    $aff_id2=$crud->create('affiliations', $fieldArr2);
                     echo 'added';
              
      }else if(!empty($id)){
      if($crud->updateAffilie('affiliations', $fieldArr2, $id)){
        echo 'updated';
      }else{
        echo 'Error';
      }
    }

}else {
  echo 'Error';
  } 