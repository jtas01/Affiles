<?php
include "../db_config.php";
$fieldArr=array();
if(isset($_POST['submit'])){
    $filename="affilie.csv";

    $file = fopen($filename, "r");
    $headers = array();
    $row=0;
    while (($data = fgetcsv($file, 10000, ",")) !== FALSE){
            $fieldArr['Cle_Affilie'] = ($data[0])?$data[0]:'';
            $fieldArr['Clé'] = ($data[1])?$data[1]:'';    
            $fieldArr['Nom_Affilié'] = ($data[2])?$data[2]:'';
            $fieldArr['Prénom_Affilié'] = ($data[3])?$data[3]:'';       
            $fieldArr['Conjoint_Affilié'] = ($data[4])?$data[4]:'';
            $fieldArr['Institution_Affilié'] = ($data[5])?$data[5]:'';    
            $fieldArr['Institution_Affilié_envoi'] = ($data[6])?$data[6]:'';
            $fieldArr['Adresse_Affilié'] = ($data[7])?$data[7]:'';    
            $fieldArr['Clé_Code_Postal'] = ($data[8])?$data[8]:'';
            $fieldArr['Adresse_envoi'] = ($data[9])?$data[9]:'';    
            $fieldArr['CP_envoi'] = ($data[10])?$data[10]:'';
            $Naissance_Affilié1=($data[11])?$data[11]:'';
            if($Naissance_Affilié1!=''){
                $str=explode('-', $Naissance_Affilié1);
                $strdate=$str[2].'-'.$str[1].'-'.$str[0];
                $Naissance_Affilié =date("Y-m-d",strtotime($strdate));
            }else{
                 $Naissance_Affilié='';   
            }
            $fieldArr['Naissance_Affilié'] = $Naissance_Affilié;   
            $fieldArr['Téléphone_Affilié'] = ($data[12])?$data[12]:'';
            $fieldArr['GSM_ou_autre_tel'] = ($data[13])?$data[13]:'';    
            $fieldArr['Courriel'] = ($data[14])?$data[14]:'';
            $fieldArr['Clé_Etat_Civil'] = ($data[15])?$data[15]:'';    
            $fieldArr['Clé_situation_familiale'] = ($data[16])?$data[16]:'';
            $fieldArr['Nbre_enfants_à_charge'] = ($data[17])?$data[17]:''; 
            $Date_du_diagnostic1=($data[18])?$data[18]:'';
            if($Date_du_diagnostic1!=''){
                $str1=explode('-', $Date_du_diagnostic1);
                $strdate1=$str1[2].'-'.$str1[1].'-'.$str1[0];
                $Date_du_diagnostic =date("Y-m-d",strtotime($strdate1));
            }else{
                $Date_du_diagnostic='';   
            }   
            $fieldArr['Date_du_diagnostic'] =$Date_du_diagnostic;
            $fieldArr['Code_handicap'] = ($data[19])?$data[19]:'';    
            $fieldArr['Clé_Province'] = ($data[20])?$data[20]:'';
            $fieldArr['Clé_Assistante_Sociale'] = ($data[21])?$data[21]:'';
            $Date_de_décès1=($data[22])?$data[22]:'';
            if($Date_de_décès1!=''){
                $str2=explode('-', $Date_de_décès1);
                $strdate2=$str2[2].'-'.$str2[1].'-'.$str2[0];
                $Date_de_décès =date("Y-m-d",strtotime($strdate2));
            }else{
                $Date_de_décès='';   
            }      
            $fieldArr['Date_de_décès'] = $Date_de_décès;
            $fieldArr['Zone_Libre'] = ($data[23])?$data[23]:'';    
            $fieldArr['Certificat_Médical'] = ($data[24])?$data[24]:'';
            $fieldArr['Rentrées_mensuelles'] = ($data[25])?$data[25]:'';    
            $fieldArr['Dépenses_mensuelles'] = ($data[26])?$data[26]:'';
            $fieldArr['Motif_de_non_réaffiliation'] = ($data[27])?$data[27]:'';    
            $fieldArr['Etiquettes_Lgt'] = ($data[28])?$data[28]:'';
            $fieldArr['Mémo'] = ($data[29])?$data[29]:'';
            $Date_Archive1=($data[30])?$data[30]:'';
            if($Date_Archive1!=''){
                $str3=explode('-', $Date_Archive1);
                $strdate3=$str3[2].'-'.$str3[1].'-'.$str3[0];
                $Date_Archive =date("Y-m-d",strtotime($strdate3));
            }else{
                $Date_Archive='';   
            }      
            $fieldArr['Date_Archive'] = $Date_Archive;
            $fieldArr['Sylvie'] = ($data[31])?$data[31]:'';
            $fieldArr['Pas_de_courriers'] = ($data[32])?$data[32]:'';
            $fieldArr['Plus_de_contact'] = ($data[33])?$data[33]:'';
            $fieldArr['Gratuit_Aff'] = ($data[34])?$data[34]:'';
            $fieldArr['Nouveau'] = ($data[35])?$data[35]:'';
            $Date_Nouveau1=($data[36])?$data[36]:'';
            if($Date_Nouveau1!=''){
                $str4=explode('-', $Date_Nouveau1);
                $strdate4=$str4[2].'-'.$str4[1].'-'.$str4[0];
                $Date_Nouveau =date("Y-m-d",strtotime($strdate4));
            }else{
                $Date_Nouveau='';   
            }     
            $fieldArr['Date_Nouveau'] = $Date_Nouveau;
            $fieldArr['Nom_Modifi'] = ($data[37])?$data[37]:'';
            $fieldArr['Inactif_Obselete'] = ($data[38])?$data[38]:'';
            $fieldArr['BIM'] = ($data[39])?$data[39]:'';
            $fieldArr['Pas_Invitation'] = ($data[40])?$data[40]:'';
            $fieldArr['Bénévole_assigné2'] = ($data[41])?$data[41]:'';
            $fieldArr['Etiquettes'] = ($data[42])?$data[42]:'';
            $fieldArr['Selections_Temporaire'] = ($data[43])?$data[43]:'';
            $fieldArr['LaClef'] = ($data[44])?$data[44]:'';
            $fieldArr['RGPD'] = ($data[45])?$data[45]:'';
            $fieldArr['VOLONTAIRE'] = ($data[46])?$data[46]:'';
            $fieldArr['Bénévole_assigné'] = ($data[47])?$data[47]:'';
            $fieldArr['Prob_adresse'] = ($data[48])?$data[48]:'';
           
                /*if($crud->create('affilie', $fieldArr)){
                    echo 'Added Successfully';  
                }*/
        if($row>0){
            // Prepare an insert statement
            $sql = "INSERT INTO affilie (Clé_Affilié,Clé,Nom_Affilié,Prénom_Affilié,Conjoint_Affilié,Institution_Affilié,Institution_Affilié_envoi,Adresse_Affilié,Clé_Code_Postal,Adresse_envoi,CP_envoi,Naissance_Affilié,Téléphone_Affilié,GSM_ou_autre_tel,Courriel,Clé_Etat_Civil,Clé_situation_familiale,Nbre_enfants_à_charge,Date_du_diagnostic,Code_handicap,Clé_Province,Clé_Assistante_Sociale,Date_de_décès,Zone_Libre,Certificat_Médical,Rentrées_mensuelles,Dépenses_mensuelles,Motif_de_non_réaffiliation,Etiquettes_Lgt,Mémo,Date_Archive,Sylvie,Pas_de_courriers,Plus_de_contact,Gratuit_Aff,Nouveau,Date_Nouveau,Nom_Modifi,Inactif_Obselete,BIM,Pas_Invitation,Bénévole_assigné2,Etiquettes,Selections_Temporaire,LaClef,RGPD,VOLONTAIRE,Bénévole_assigné,Prob_adresse) VALUES(:Clé_Affilié, :Clé, :Nom_Affilié, :Prénom_Affilié, :Conjoint_Affilié, :Institution_Affilié, :Institution_Affilié_envoi, :Adresse_Affilié, :Clé_Code_Postal, :Adresse_envoi, :CP_envoi, :Naissance_Affilié, :Téléphone_Affilié, :GSM_ou_autre_tel, :Courriel, :Clé_Etat_Civil, :Clé_situation_familiale, :Nbre_enfants_à_charge, :Date_du_diagnostic, :Code_handicap, :Clé_Province, :Clé_Assistante_Sociale, :Date_de_décès, :Zone_Libre, :Certificat_Médical, :Rentrées_mensuelles, :Dépenses_mensuelles, :Motif_de_non_réaffiliation, :Etiquettes_Lgt, :Mémo, :Date_Archive, :Sylvie, :Pas_de_courriers, :Plus_de_contact, :Gratuit_Aff, :Nouveau, :Date_Nouveau, :Nom_Modifi, :Inactif_Obselete, :BIM, :Pas_Invitation, :Bénévole_assigné2, :Etiquettes, :Selections_Temporaire, :LaClef, :RGPD, :VOLONTAIRE,:Bénévole_assigné, :Prob_adresse)";
                if ($stmt = $pdo->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":Clé_Affilié", $param_Clé_Affilié);
                    $stmt->bindParam(":Clé", $param_Clé);
                    $stmt->bindParam(":Nom_Affilié", $param_Nom_Affilié);
                    $stmt->bindParam(":Prénom_Affilié", $param_Prénom_Affilié);
                    $stmt->bindParam(":Conjoint_Affilié", $param_Conjoint_Affilié);
                    $stmt->bindParam(":Institution_Affilié", $param_Institution_Affilié);
                    $stmt->bindParam(":Institution_Affilié_envoi", $param_Institution_Affilié_envoi);
                    $stmt->bindParam(":Adresse_Affilié", $param_Adresse_Affilié);
                    $stmt->bindParam(":Clé_Code_Postal", $param_Clé_Code_Postal);
                    $stmt->bindParam(":Adresse_envoi", $param_Adresse_envoi);

                    $stmt->bindParam(":CP_envoi", $param_CP_envoi);
                    $stmt->bindParam(":Naissance_Affilié", $param_Naissance_Affilié);
                    $stmt->bindParam(":Téléphone_Affilié", $param_Téléphone_Affilié);
                    $stmt->bindParam(":GSM_ou_autre_tel", $param_GSM_ou_autre_tel);
                    $stmt->bindParam(":Courriel", $param_Courriel);
                    $stmt->bindParam(":Clé_Etat_Civil", $param_Clé_Etat_Civil);
                    $stmt->bindParam(":Clé_situation_familiale", $param_Clé_situation_familiale);
                    $stmt->bindParam(":Nbre_enfants_à_charge", $param_Nbre_enfants_à_charge);
                    $stmt->bindParam(":Date_du_diagnostic", $param_Date_du_diagnostic);
                    $stmt->bindParam(":Code_handicap", $param_Code_handicap);

                    $stmt->bindParam(":Clé_Province", $param_Clé_Province);
                    $stmt->bindParam(":Clé_Assistante_Sociale", $param_Clé_Assistante_Sociale);
                    $stmt->bindParam(":Date_de_décès", $param_Date_de_décès);
                    $stmt->bindParam(":Zone_Libre", $param_Zone_Libre);
                    $stmt->bindParam(":Certificat_Médical", $param_Certificat_Médical);
                    $stmt->bindParam(":Rentrées_mensuelles", $param_Rentrées_mensuelles);
                    $stmt->bindParam(":Clé_situation_familiale", $param_Clé_situation_familiale);
                    $stmt->bindParam(":Dépenses_mensuelles", $param_Dépenses_mensuelles);
                    $stmt->bindParam(":Motif_de_non_réaffiliation", $param_Motif_de_non_réaffiliation);
                    $stmt->bindParam(":Etiquettes_Lgt", $param_Etiquettes_Lgt);

                    $stmt->bindParam(":Mémo", $param_Mémo);
                    $stmt->bindParam(":Date_Archive", $param_Date_Archive);
                    $stmt->bindParam(":Sylvie", $param_Sylvie);
                    $stmt->bindParam(":Pas_de_courriers", $param_Pas_de_courriers);
                    $stmt->bindParam(":Plus_de_contact", $param_Plus_de_contact);
                    $stmt->bindParam(":Gratuit_Aff", $param_Gratuit_Aff);
                    $stmt->bindParam(":Nouveau", $param_Nouveau);
                    $stmt->bindParam(":Date_Nouveau", $param_Date_Nouveau);
                    $stmt->bindParam(":Nom_Modifi", $param_Nom_Modifi);
                    $stmt->bindParam(":Inactif_Obselete", $param_Inactif_Obselete);

                    $stmt->bindParam(":BIM", $param_BIM);
                    $stmt->bindParam(":Pas_Invitation", $param_Pas_Invitation);
                    $stmt->bindParam(":Bénévole_assigné2", $param_Bénévole_assigné2);
                    $stmt->bindParam(":Etiquettes", $param_Etiquettes);
                    $stmt->bindParam(":Selections_Temporaire", $param_Selections_Temporaire);
                    $stmt->bindParam(":LaClef", $param_LaClef);
                    $stmt->bindParam(":RGPD", $param_RGPD);
                    $stmt->bindParam(":VOLONTAIRE", $param_VOLONTAIRE);
                    $stmt->bindParam(":Bénévole_assigné", $param_Bénévole_assigné);
                    $stmt->bindParam(":Prob_adresse", $param_Prob_adresse);

                    // Set parameters
                    $param_Clé_Affilié = $fieldArr['Clé_Affilié'];
                    $param_Clé = $fieldArr['Clé'];
                    $param_Nom_Affilié = $fieldArr['Nom_Affilié'];
                    $param_Prénom_Affilié = $fieldArr['Prénom_Affilié'];
                    $param_Conjoint_Affilié = $fieldArr['Conjoint_Affilié'];
                    $param_Institution_Affilié =$fieldArr['Institution_Affilié'];
                    $param_Institution_Affilié_envoi = $fieldArr['Institution_Affilié_envoi'];
                    $param_Adresse_Affilié = $fieldArr['Adresse_Affilié'];
                    $param_Clé_Code_Postal = $fieldArr['Clé_Code_Postal'];
                    $param_Adresse_envoi = $fieldArr['Adresse_envoi'];
                    $param_CP_envoi = $fieldArr['CP_envoi'];
                    $param_Naissance_Affilié =$fieldArr['Naissance_Affilié'];
                    $param_Téléphone_Affilié =$fieldArr['Téléphone_Affilié'];
                    $param_GSM_ou_autre_tel = $fieldArr['GSM_ou_autre_tel'];;
                    $param_Courriel = $fieldArr['Courriel'];
                    $param_Clé_Etat_Civil =$fieldArr['Clé_Etat_Civil'];
                    $param_Clé_situation_familiale = $fieldArr['Clé_situation_familiale'];
                    $param_Nbre_enfants_à_charge = $fieldArr['Nbre_enfants_à_charge'];
                    $param_Date_du_diagnostic = $fieldArr['Date_du_diagnostic']; 
                    $param_Code_handicap = $fieldArr['Code_handicap'];
                    $param_Clé_Province = $fieldArr['Clé_Province'];
                    $param_Clé_Assistante_Sociale = $fieldArr['Clé_Assistante_Sociale'];
                    $param_Date_de_décès = $fieldArr['Date_de_décès'];;
                    $param_Zone_Libre = $fieldArr['Zone_Libre'];
                    $param_Certificat_Médical = $fieldArr['Certificat_Médical'];
                    $param_Rentrées_mensuelles = $fieldArr['Rentrées_mensuelles'];
                    $param_Clé_situation_familiale = $fieldArr['Clé_situation_familiale'];
                    $param_Dépenses_mensuelles = $fieldArr['Dépenses_mensuelles'];
                    $param_Motif_de_non_réaffiliation = $fieldArr['Motif_de_non_réaffiliation'];
                    $param_Etiquettes_Lgt = $fieldArr['Etiquettes_Lgt'];
                    $param_Mémo = $fieldArr['Mémo'];
                    $param_Date_Archive =$fieldArr['Date_Archive'];
                    $param_Sylvie = $fieldArr['Sylvie'];
                    $param_Pas_de_courriers = $fieldArr['Pas_de_courriers'];
                    $param_Plus_de_contact = $fieldArr['Plus_de_contact'];
                    $param_Gratuit_Aff = $fieldArr['Gratuit_Aff'];
                    $param_Nouveau = $fieldArr['Nouveau'];
                    $param_Date_Nouveau = $fieldArr['Date_Nouveau'];
                    $param_Nom_Modifi = $fieldArr['Nom_Modifi'];
                    $param_Inactif_Obselete = $fieldArr['Inactif_Obselete'];
                    $param_BIM = $fieldArr['BIM'];
                    $param_Pas_Invitation = $fieldArr['Pas_Invitation'];
                    $param_Bénévole_assigné2 = $fieldArr['Bénévole_assigné2'];
                    $param_Etiquettes = $fieldArr['Etiquettes'];
                    $param_Selections_Temporaire = $fieldArr['Selections_Temporaire'];
                    $param_LaClef = $fieldArr['LaClef'];
                    $param_RGPD = $fieldArr['RGPD'];
                    $param_VOLONTAIRE = $fieldArr['VOLONTAIRE'];
                    $param_Bénévole_assigné = $fieldArr['Bénévole_assigné'];
                    $param_Prob_adresse = $fieldArr['Prob_adresse'];
                    
                   $res=$stmt->execute();
                    // Attempt to execute the prepared statement
                    if($res){

                        // Records created successfully. Redirect to landing page
                        echo 'Added Successfully';
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";


                    }
                }
              
        }       
      
           
            $row++;
      
    }
 }  
?>
<form name="frm" action="" method="post">
<input type="submit" name="submit" value="Import Affile DB">   
</form>


