<?php
require_once "../config/db_config.php";
if(isset($_POST['id'])){
    $id=$_POST['id'];
}else{
    $id='';
}
echo selectAllRecords($pdo, 'affilie', $id);
function selectAllRecords($pdo, $tablename, $id){
    $members = [];
    $j = 0;
 // echo $query = "SELECT * FROM affilie t1 INNER JOIN  affiliations t2 ON t1.`Clé Affilié` = t2.`Clé Affilié` INNER JOIN affiliés_contacts t3 ON t1.`Clé Affilié` = t3.`ID_Affiliés` WHERE t1.`Clé Affilié` =".$id;

    if($id){
        $query = "SELECT * FROM affilie  WHERE `Clé Affilié` =".$id;
    }  else{
        $query = "SELECT * FROM affilie";
    }

    $result =  $pdo->query($query);
    $count=$result->rowCount();
    if($count>0) {
        while ($row = $result->fetch()) {
            $response[]=array(
                    'cle_id' => $row['Clé_Affilié'],
                    'nom_affilie' => $row['Nom_Affilié'],
                    'prenom_affilie' => $row['Prénom_Affilié'],
                    'address_affilie' => $row['Adresse_Affilié'],
                    'insti_affilie' => $row['Institution_Affilié'],
                    'insti_affilie_envoi' => $row['Institution_Affilié_envoi'],
                    'conjoint_affilie' => $row['Conjoint_Affilié'],
                    'address_envoi' => $row['Adresse_envoi'],
                     'cp' => $row['Clé_Code_Postal'],
                    'cp_envoi' => $row['CP_envoi'],
                    'naissance_affilie' => $row['Naissance_Affilié'],
                    'tele_affilie' => $row['Téléphone_Affilié'],
                    'gsm_ou_autre_tel' => $row['GSM_ou_autre_tel'],
                    'courriel' => $row['Courriel'],
                    'cle_etat_civil' => $row['Clé_Etat_Civil'],
                    'cle_situation_familiale' => $row['Clé_situation_familiale'],
                    'nbre_enfants' => $row['Nbre_enfants_à_charge'],
                    'date_du_diagnostic' => $row['Date_du_diagnostic'],
                    'code_handicaped' => $row['Code_handicap'],
                    'province' => $row['Clé_Province'],
                    'cle_assistante_sociale' => $row['Clé_Assistante_Sociale'],
                    'date_de_deces' => $row['Date_de_décès'],
                    'zone_libre' => $row['Zone_Libre'],
                    'certi_medical' => $row['Certificat_Médical'],
                    'rentrees_mensuelles' => $row['Rentrées_mensuelles'],
                    'depenses_mensuelles' => $row['Dépenses_mensuelles'],
                    'motif' => $row['Motif_de_non_réaffiliation'],
                    'Etiquettes_Lgt' => $row['Etiquettes_Lgt'],
                    'memo' => $row['Mémo'],
                    'Date_Archive' => $row['Date_Archive'],
                    'Sylvie' => $row['Sylvie'],
                    'pas_de_courriers' => $row['Pas_de_courriers'],
                    'plus_de_contact' => $row['Plus_de_contact'],
                    'Gratuit_Aff' => $row['Gratuit_Aff'],
                    'Nouveau' => $row['Nouveau'],
                    'Date_Nouveau' => $row['Date_Nouveau'],
                    'Nom_Modifi' => $row['Nom_Modifi'],
                    'Inactif_Obselete' => $row['Inactif-Obselete'],
                    'Date_Nouveau' => $row['Date_Nouveau'],
                    'Nom_Modifi' => $row['Nom_Modifi'],
                     'BIM' => $row['BIM'],
                    'Pas_Invitation' => $row['Pas_Invitation'],
                    'benevole_assign2' => $row['Bénévole_assigné2'],
                    'Etiquettes' => $row['Etiquettes'],
                    'Selections_Temporaire' => $row['Selections_Temporaire'],
                    'LaClef' => $row['LaClef'],
                    'RGPD' => $row['RGPD'],
                    'VOLONTAIRE' => $row['VOLONTAIRE'],
                    'benevole_assign' => $row['Bénévole_assigné'],
                    'Prob_adresse' => $row['Prob_adresse'],
                    'status' => $row['status'],
                    'social_status' => $row['social_status'],
                    'Nouveau' => $row['Nouveau'],
                    'IM' => $row['IM'],
                    'message' => 'Success'
                );
             
        }
         echo json_encode($response);
    }
   
}




?>