<?php
session_start();
require_once "../config/db_config.php";
//print_r($_POST);
if(isset($_POST['nom_affilie']) && !empty($_POST['nom_affilie']) && isset($_POST['courriel']) && !empty($_POST['courriel'])){
    $fieldArr['Clé']  = $_SESSION['N°'];
    $fieldArr['Nom_Affilié']  = (isset($_POST['nom_affilie'])) ? $_POST['nom_affilie'] : '';
    $fieldArr['Prénom_Affilié'] = (isset($_POST['prenom_affilie'])) ? $_POST['prenom_affilie'] : '';
    $fieldArr['Courriel'] = (isset($_POST['courriel'])) ? $_POST['courriel'] : '';
    $fieldArr['social_status'] = (isset($_POST['social_status'])) ? $_POST['social_status'] : '';
    $fieldArr['status'] = (isset($_POST['status'])) ? $_POST['status'] : '';
    $fieldArr['Clé_Code_Postal'] = (isset($_POST['cp'])) ? $_POST['cp'] : '';
    $fieldArr['CP_envoi'] = (isset($_POST['cp_envoi'])) ? $_POST['cp_envoi'] : '';
    $fieldArr['Institution_Affilié'] = (isset($_POST['insti_affilie'])) ? $_POST['insti_affilie'] : '';
     $fieldArr['Adresse_envoi'] = (isset($_POST['address_envoi'])) ? $_POST['address_envoi'] : '';
    $fieldArr['Adresse_Affilié'] = (isset($_POST['address_affilie'])) ? $_POST['address_affilie'] : '';
    $fieldArr['Conjoint_Affilié']  = (isset($_POST['conjoint_affilie'])) ? $_POST['conjoint_affilie'] : '';
    $fieldArr['GSM_ou_autre_tel'] = (isset($_POST['gsm_ou_autre_tel'])) ? $_POST['gsm_ou_autre_tel'] : '';
    $fieldArr['Institution_Affilié_envoi'] = (isset($_POST['insti_affilie_envoi'])) ? $_POST['insti_affilie_envoi'] : '';
    $fieldArr['Clé_Assistante_Sociale'] = (isset($_POST['assistantes'])) ? $_POST['assistantes'] : '';
    $fieldArr['Mémo'] = (isset($_POST['memo'])) ? $_POST['memo'] : '';
     $fieldArr['Nbre_enfants_à_charge']  = (isset($_POST['nbre_enfants'])) ? $_POST['nbre_enfants'] : '';
    $fieldArr['Naissance_Affilié'] = (isset($_POST['naissance_affilie'])) ? $_POST['naissance_affilie'] : '';
    $fieldArr['Téléphone_Affilié'] = (isset($_POST['tele_affilie'])) ? $_POST['tele_affilie'] : '';
    $fieldArr['Clé_Province'] = (isset($_POST['province'])) ? $_POST['province'] : '';
    $fieldArr['Date_de_décès'] = (isset($_POST['date_of_deces'])) ? $_POST['date_of_deces'] : '';
     $fieldArr['Date_du_diagnostic']  = (isset($_POST['date_du_diagnostic'])) ? $_POST['date_du_diagnostic'] : '';
    $fieldArr['Clé_situation_familiale'] = (isset($_POST['cle_situation_familiale'])) ? $_POST['cle_situation_familiale'] : '';
    $fieldArr['Code_handicap'] = (isset($_POST['code_handicaped'])) ? $_POST['code_handicaped'] : '';
    $fieldArr['Sylvie'] = (isset($_POST['Sylvie'])) ? $_POST['Sylvie'] : '';
    $fieldArr['Clé_Etat_Civil'] = (isset($_POST['cle_etat_civil'])) ? $_POST['cle_etat_civil'] : '';  

     $fieldArr['Inactif-Obselete'] = (isset($_POST['Inactif_Obselete'])) ? $_POST['Inactif_Obselete'] : '';
    $fieldArr['BIM'] = (isset($_POST['BIM'])) ? $_POST['BIM'] : '';
    $fieldArr['RGPD'] = (isset($_POST['RGPD'])) ? $_POST['RGPD'] : '';  
     $fieldArr['VOLONTAIRE'] = (isset($_POST['VOLONTAIRE'])) ? $_POST['VOLONTAIRE'] : '';
    $fieldArr['Pas_Invitation'] = (isset($_POST['Pas_Invitation'])) ? $_POST['Pas_Invitation'] : '';
    $fieldArr['Pas_de_courriers'] = (isset($_POST['pas_de_courriers'])) ? $_POST['pas_de_courriers'] : '';  
     $fieldArr['Plus_de_contact'] = (isset($_POST['plus_de_contact'])) ? $_POST['plus_de_contact'] : '';
    $fieldArr['Gratuit_Aff'] = (isset($_POST['Gratuit_Aff'])) ? $_POST['Gratuit_Aff'] : '';
    $fieldArr['IM'] = (isset($_POST['IM'])) ? $_POST['IM'] : '';
    $fieldArr['LaClef'] = (isset($_POST['LaClef'])) ? $_POST['LaClef'] : '';
    $fieldArr['Nouveau'] = (isset($_POST['Nouveau'])) ? $_POST['Nouveau'] : '';
    $fieldArr['Etiquettes'] = (isset($_POST['Etiquettes'])) ? $_POST['Etiquettes'] : '';

    $fieldArr1['Type']  = (isset($_POST['type'])) ? $_POST['type'] : '';
    $fieldArr1['Nom'] = (isset($_POST['nom'])) ? $_POST['nom'] : '';
    $fieldArr1['Prénom'] = (isset($_POST['prenom'])) ? $_POST['prenom'] : '';
    $fieldArr1['Tél'] = (isset($_POST['telephone'])) ? $_POST['telephone'] : '';
    $fieldArr1['Gsm'] = (isset($_POST['gsm'])) ? $_POST['gsm'] : '';
    $fieldArr1['Email'] = (isset($_POST['email'])) ? $_POST['email'] : '';

    $fieldArr2['Année Affiliation']  = (isset($_POST['anne_year'])) ? $_POST['anne_year'] : '';
    $fieldArr2['Date Affiliation'] = (isset($_POST['date_affilie'])) ? $_POST['date_affilie'] : '';
    $fieldArr2['Montant'] = (isset($_POST['montant'])) ? $_POST['montant'] : '';
    $fieldArr2['Clé type affiliation'] = (isset($_POST['type_affiliation'])) ? $_POST['type_affiliation'] : '';
    $fieldArr2['Mode de paiement'] = (isset($_POST['mode_payment'])) ? $_POST['mode_payment'] : '';
    $fieldArr2['Payé par'] = (isset($_POST['paid_by'])) ? $_POST['paid_by'] : '';
     $id = (isset($_POST['cle_id'])) ? $_POST['cle_id'] : '';
  if(empty($id)){
     if(filter_var($_POST['courriel'], FILTER_VALIDATE_EMAIL))
        {
            $sql = 'select * from affilie where Courriel = :Courriel';
            $stmt = $pdo->prepare($sql);
            $p = ['Courriel'=>$_POST['courriel']];
            $stmt->execute($p);

            if($stmt->rowCount() == 0)
            { 
              $aff_id=$crud->create('affilie', $fieldArr);
              echo 'added';
              if($aff_id>0 && $_POST['anne_year']!='' && $_POST['montant']!='' && $_POST['mode_payment']!='' ){

                    $fieldArr2['Clé Affilié']  = $aff_id;
                   
                    $aff_id2=$crud->create('affiliations', $fieldArr2);
                     
                }
               if($aff_id>0 && isset($_POST['email']) && $_POST['email']!=''){

                    $fieldArr1['ID_Affiliés']  = $aff_id;
                   
                    $aff_id1=$crud->create('affiliés_contacts', $fieldArr1);
                    
                }
            }else{
                echo 'Email Already Exist Error';
            }
        }

  }else if(!empty($id)){
    if($crud->update('affilie', $fieldArr, $id)){
       echo 'updated';
     
    }else{
      echo 'Error';
    }
  }

       
   
    
}else {
  echo 'Error';
  } 