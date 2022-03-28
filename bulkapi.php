<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'header.php';
include 'db_config.php';
include 'bulkapi/classes/ZohoCrmClient.php';
$crmObj = new ZohoCrmClient();
$company = [];
?>

<a href="http://www.crm.eliaspartners.be/bulkapi.php">refresh page</a>
<a href="https://accounts.zoho.eu/oauth/v2/auth?scope=ZohoCRM.bulk.ALL,ZohoCRM.modules.ALL,ZohoCRM.settings.ALL&client_id=1000.B2FOMAWHMWXTX061U79W0Z88U4TWFY&response_type=code&access_type=offline&redirect_uri=https://www.crm.eliaspartners.be/bulkapi.php">Generate bulk api code</a>
<!--<a href="https://accounts.zoho.in/oauth/v2/auth?scope=ZohoCRM.modules.ALL,ZohoCRM.settings.ALL&client_id=1000.TFRMAJ3R89XXR8HL3JBY5IM5ET78BZ&response_type=code&access_type=offline&redirect_uri=http://localhost/crm/zohocrm.php">Generate code</a>-->

<a href="https://accounts.zoho.eu/oauth/v2/auth?scope=WorkDrive.team.ALL,WorkDrive.workspace.ALL,WorkDrive.files.ALL,ZohoCRM.modules.attachments.ALL&client_id=1000.SDKK6DLDHTQX5ITOKVLICCDOPBR22Z&response_type=code&access_type=offline&redirect_uri=https://www.crm.eliaspartners.be/bulkapi.php">Generate code</a>

<a href="https://accounts.zoho.eu/oauth/v2/auth?scope=ZohoCRM.org.ALL,ZohoFiles.files.ALL,ZohoCRM.bulk.ALL,ZohoCRM.modules.ALL,ZohoCRM.settings.ALL&client_id=1000.B2FOMAWHMWXTX061U79W0Z88U4TWFY&response_type=code&access_type=offline&redirect_uri=https://www.crm.eliaspartners.be/bulkapi.php">Generate Bulkapi chandra id</a>

<a href="https://accounts.zoho.eu/oauth/v2/auth?scope=ZohoCRM.org.ALL,ZohoFiles.files.ALL,ZohoCRM.bulk.ALL,ZohoCRM.modules.ALL,ZohoCRM.settings.ALL&client_id=1000.SDKK6DLDHTQX5ITOKVLICCDOPBR22Z&response_type=code&access_type=offline&redirect_uri=https://www.crm.eliaspartners.be/bulkapi.php">Generate Bulkapi client id</a>

<?php

    $code= $_REQUEST['code'];
    echo 'chandra'.$code;
    echo '<br><br><br>';
  
$refreshtoken1= json_decode(gettoken($code))->refresh_token;
        echo '<br><br><br>';
        echo '<br><br><br>';
    echo $accesstoken1= json_decode(refreshtoken($refreshtoken))->access_token;
        echo '<br><br><br>';

if(isset($_POST['addBatiments'])){  
            echo $accesstoken=$crmObj->getAccessTokenforBulkApi(); 
        echo '<br><br><br>';
    
    $str=json_decode(GetBatimentsRecords($accesstoken));
    $id=$str->data[0]->details->id;
    $str1=json_decode($crmObj->statusofjob($id));
     $state=$str1->data[0]->state;
    $fields=$str1->data[0]->query->fields;
    $download_url=$str1->data[0]->result->download_url;
    // Print to file
     $handle5 = fopen('downloadBatiments.txt', 'w');
    fwrite($handle5, $id);
    fclose($handle5);       
    if($state=='COMPLETED'){
        $str2=DownloadBulkReadResult($accesstoken,$id);
    }
}
if(isset($_POST['addAccounts'])){  
    $accesstoken=$crmObj->getAccessTokenforBulkApi(); 
    $str=json_decode(GetAccountsRecords($accesstoken));
    print_r($str);
    $id3=$str->data[0]->details->id;
    $str1=json_decode($crmObj->statusofjob($id3));
    $state=$str1->data[0]->state;
    $fields=$str1->data[0]->query->fields;
    $download_url=$str1->data[0]->result->download_url;
    $handle5 = fopen('downloadAccounts.txt', 'w');
    fwrite($handle5, $id3);
    fclose($handle5);
    if($state=='COMPLETED'){
        $str2=$crmObj->DownloadBulkReadResult($id3);
    }
} 
  
if(isset($_POST['downloadBatiments'])){  
    $myfile = fopen("downloadBatiments.txt", "r") or die("Unable to open file!");
    $id2= fgets($myfile);
    fclose($myfile);
    $str1=json_decode($crmObj->statusofjob($id2));
    $state=$str1->data[0]->state;
    $fields=$str1->data[0]->query->fields;
    if($state=='COMPLETED'){
        $str2=$crmObj->DownloadBulkReadResult($id2);
    }
}
if(isset($_POST['downloadAccounts'])){   
    $myfile = fopen("downloadAccounts.txt", "r") or die("Unable to open file!");
   echo $id1= fgets($myfile);
    fclose($myfile);
    $str1=json_decode($crmObj->statusofjob($id1));
    print_r($str1);
    $state=$str1->data[0]->state;
   echo $fields=$str1->data[0]->query->fields;
   echo $download_url=$str1->data[0]->result->download_url;
    if($state=='COMPLETED'){
        echo 'chandra';
        $str2=$crmObj->DownloadBulkReadResult($id1);
         print_r($str2);
    }
}





function insertDataInDB($filename){
    
    $zohoid=isset($_REQUEST['id'])?$_REQUEST['id']:null;
    $name=isset($_POST['nom_du_batiment'])?$_POST['nom_du_batiment']:null;
    $rue=isset($_POST['rue'])?$_POST['rue']:null;
    $cp=isset($_POST['cp'])?$_POST['cp']:null;
    $ville=isset($_POST['ville'])?$_POST['ville']:null;
    $quartier_du_batiment=isset($_POST['quartier_du_batiment'])?$_POST['quartier_du_batiment']:null;
    $nom_du_proprietaire=isset($_POST['nom_du_proprietaire'])?$_POST['nom_du_proprietaire']:null;
    $contact_proprietaire=isset($_POST['contact_proprietaire'])?$_POST['contact_proprietaire']:null;
    $asset_manager=isset($_POST['asset_manager'])?$_POST['asset_manager']:null;
    $surface=isset($_POST['surface'])?$_POST['surface']:null;
    foreach($fields as $key=>$value){

       
            // Prepare an insert statement
            // $sql = "INSERT INTO batiments (zoho_batiment_id,bname, rue, cp, ville, quarter, pname, cpname, assets, surface, synopsis, descri, added_date) VALUES (:zoho_batiment_id,:bname, :rue, :cp, :ville, :quarter, :pname, :cpname, :assets, :surface, :synopsis, :descri, :added_date)";


           /* if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":zoho_batiment_id", $param_zoho_id);
                $stmt->bindParam(":bname", $param_bname);
                $stmt->bindParam(":rue", $param_rue);
                $stmt->bindParam(":cp", $param_cp);
                $stmt->bindParam(":ville", $param_ville);
                $stmt->bindParam(":quarter", $param_quarter);
                $stmt->bindParam(":pname", $param_pname);
                $stmt->bindParam(":cpname", $param_contact_proprietaire);
                $stmt->bindParam(":assets", $param_assets);
                $stmt->bindParam(":surface", $param_surface);
                $stmt->bindParam(":synopsis", $param_synopsis);
                $stmt->bindParam(":descri", $param_descri);
                $stmt->bindParam(":added_date", $param_added_date);

                $param_zoho_id = $zohoid;
                $param_bname = $name;
                $param_rue = $rue;
                $param_ville = $ville;
                $param_quarter = $quartier_du_batiment;
                $param_cp = $cp;
                $param_pname = $nom_du_proprietaire;
                $param_contact_proprietaire = $contact_proprietaire;
                $param_assets = $asset_manager;
                $param_surface = $surface;
                $param_synopsis = $filename;
                $param_descri = $str;
                $param_added_date = date('Y-m-d h:i:s');

                // Attempt to execute the prepared statement
                if($stmt->execute()){

                    return 'added successfully.';
                }
            }*/
    }
}

function gettoken($code){

 /*$data=[
    "grant_type"=>"authorization_code",
    "client_id"=>"1000.B2FOMAWHMWXTX061U79W0Z88U4TWFY",
    "client_secret"=>"abcd984c5a96855344496cdb2a53ebc20e8790b1b6",
    "code"=>$code,
    "redirect_uri"=>"https://www.crm.eliaspartners.be/bulkapi.php"
    ];*/
   
$data=[
    "grant_type"=>"authorization_code",
    "client_id"=>"1000.SDKK6DLDHTQX5ITOKVLICCDOPBR22Z",
    "client_secret"=>"70ad355a5845b03de2d2ffe2ef8502233011775138",
    "code"=>$code,
    "redirect_uri"=>"https://www.crm.eliaspartners.be/bulkapi/bulkapi.php"
    ];

    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'https://accounts.zoho.eu/oauth/v2/token');
    curl_setopt($curl_handle,CURLOPT_POST,true);
    curl_setopt($curl_handle,CURLOPT_POSTFIELDS,$data);
    curl_setopt($curl_handle,CURLOPT_HEADER, false);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $buffer = curl_exec($curl_handle);
    var_dump($buffer);
    curl_close($curl_handle);
    return $buffer;
}

function refreshtoken($refreshtoken){

 $data=[

    "grant_type"=>"refresh_token",
    "refresh_token"=>$refreshtoken,
    "client_id"=>"1000.B2FOMAWHMWXTX061U79W0Z88U4TWFY",
    "client_secret"=>"abcd984c5a96855344496cdb2a53ebc20e8790b1b6"
    ];
     /*$data=[

    "grant_type"=>"refresh_token",
    "refresh_token"=>$refreshtoken,
    "client_id"=>"1000.SDKK6DLDHTQX5ITOKVLICCDOPBR22Z",
    "client_secret"=>"70ad355a5845b03de2d2ffe2ef8502233011775138"
    ];*/

    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'https://accounts.zoho.eu/oauth/v2/token');
    curl_setopt($curl_handle,CURLOPT_POST,true);
    curl_setopt($curl_handle,CURLOPT_POSTFIELDS,$data);
    curl_setopt($curl_handle,CURLOPT_HEADER, false);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
    var_dump($buffer);
    return $buffer;
}

function GetBatimentsRecords($accesstoken){
    $curl_options = array();
    $requestBody = array();
    $callback = array();
    $callback["url"]="https://www.crm.eliaspartners.be/bulkapi.php";
    $callback["method"]="post";
    $query = array();
    $query["module"]="Batiments";
    $fields = array();
    $fields[] = "id";
    $fields[] = "Name";
    $fields[] = "Address_du_batiment";
    $fields[] = "Surface_de_batiment";
    $fields[] = "Remarques_sur_batiment";
    $fields[] = "Quartier_du_batiment";
    $fields[] = "Commune";
    $fields[] = "Nom_du_proprietaire";
    $fields[] = "Contact_proprietaire";
    $fields[] = "Asset_manager";
    $fields[] = "Workdrive_Folder_Id";
    $fields[] = "Workdrive_Folder_Url";
    $fields[] = "Owner";
    $fields[] = "Owner.last_name";
    $fields[] = "Created_Time";
    $requestBody["callback"] =$callback;
    $query["fields"]=$fields;


    $criteria = array();
    // $criteria["group_operator"]="or";
    // $group = array();
    // $criteria1 = array();
    // $criteria1["api_name"]="Lead_Source";
    // $criteria1["comparator"]="equal";
    // $criteria1["value"]="Advertisement";
    // $criteria2 = array();   
    // $criteria2["api_name"]="Owner.last_name";
    // $criteria2["comparator"]="equal";
    // $criteria2["value"]="Boyle";
    // $criteria3 = array();
    // $criteria3["api_name"]="Account_Name.Phone";
    //  $criteria3["comparator"]="contains";
    //  $criteria3["value"]="5";
    // $group = [$criteria1,$criteria2,$criteria3];
    // $criteria["group"] = $group;
    // $query["criteria"] =$criteria;
    $query["page"] =1;
    $requestBody["query"]=$query;

    $postData=json_encode($requestBody);
    $url = 'https://www.zohoapis.eu/crm/bulk/v2/read';           
    $headers = array('Authorization: Zoho-oauthtoken '.$accesstoken, 'Content-type: application/json'); // return datatype
    $ch = curl_init(); // Create a curl handle
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
    curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
    curl_setopt($ch, CURLOPT_POST, FALSE);  // To set POST method true
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // To send data to the API URL
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
    return $response = curl_exec($ch); // To execute the handle and get the response       
    // $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get Http Status code
}
function GetAccountsRecords($accesstoken){
    $curl_options = array();
    $requestBody = array();
    $callback = array();
    $callback["url"]="https://www.crm.eliaspartners.be/bulkapi.php";
    $callback["method"]="post";
    $query = array();
    $query["module"]="Accounts";
    $fields = array();
    $fields[] = "id";
    $fields[] = "Account_Name";
    $fields[] = "Building";
    $fields[] = "Date_du_bail";
    $fields[] = "Evalution";
    $fields[] = "Evalution_commentries";
    $fields[] = "Fin_de_bail";
    $fields[] = "Gestionnaire_du_compte";
    $fields[] = "Phone";
    $fields[] = "Remarques";
    $fields[] = "Surface_de_Bureaux_Client";
    $fields[] = "Workdrive_Folder_Id";
    $fields[] = "Workdrive_Folder_Url";
    $fields[] = "Owner";
    $fields[] = "Owner.last_name";
    $fields[] = "Created_Time";
    $requestBody["callback"] =$callback;
    $query["fields"]=$fields;


    $criteria = array();
    // $criteria["group_operator"]="or";
    // $group = array();
    // $criteria1 = array();
    // $criteria1["api_name"]="Lead_Source";
    // $criteria1["comparator"]="equal";
    // $criteria1["value"]="Advertisement";
    // $criteria2 = array();   
    // $criteria2["api_name"]="Owner.last_name";
    // $criteria2["comparator"]="equal";
    // $criteria2["value"]="Boyle";
    // $criteria3 = array();
    // $criteria3["api_name"]="Account_Name.Phone";
    //  $criteria3["comparator"]="contains";
    //  $criteria3["value"]="5";
    // $group = [$criteria1,$criteria2,$criteria3];
    // $criteria["group"] = $group;
    // $query["criteria"] =$criteria;
    $query["page"] =1;
    $requestBody["query"]=$query;

    $postData=json_encode($requestBody);
    $url = 'https://www.zohoapis.eu/crm/bulk/v2/read';           
    $headers = array('Authorization: Zoho-oauthtoken '.$accesstoken, 'Content-type: application/json'); // return datatype
    $ch = curl_init(); // Create a curl handle
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
    curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
    curl_setopt($ch, CURLOPT_POST, FALSE);  // To set POST method true
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // To send data to the API URL
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
    return $response = curl_exec($ch); // To execute the handle and get the response       
    // $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get Http Status code
}

if(isset($_POST['submit']) && $_POST['submit']=='Import Accounts'){

}
?>

<form name="frm" action="" method="post">
<input type="submit" name="downloadAccounts" value="Download Accounts">   
</form><br>
<form name="frm" action="" method="post">
<input type="submit" name="addAccounts" value="create job id Accounts">   
</form>
<br>
<form name="frm" action="" method="post">
<input type="submit" name="addBatiments" value="create job id Batiments">   
</form>
<br>
<form name="frm" action="" method="post">
<input type="submit" name="downloadBatiments" value="Download Batiments">   
</form>
<br>
