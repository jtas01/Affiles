<?php
include "../db_config.php";
//$fieldArr=array();
if(isset($_POST['submit'])){
    $filename="affilie.csv";

    $file = fopen($filename, "r");
    $headers = array();
    $row=0;
    while (($data = fgetcsv($file, 10000, ",")) !== FALSE){
            $fieldArr['Clé Affilié'] = ($data[0])?$data[0]:'';
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
           
                if($crud->create('affilie', $fieldArr)){
                    echo 'Added Successfully';  
                }
       
           
            $row++;
      
    }
 }  
?>
<form name="frm" action="" method="post">
<input type="submit" name="submit" value="Import Affile DB">   
</form>


