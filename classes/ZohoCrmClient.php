<?php
Class ZohoCrmClient { 

    public function getAccessToken(){ 
        $crm_config = include('../crm_config.php');
        $zoho_crm_session = file_get_contents($crm_config['base_url'].'access_token.json');
        $zoho_crm_session = json_decode($zoho_crm_session);
        $current_time = date('Y-m-d H:i:s');

        if(isset($zoho_crm_session->access_token) && ($current_time<$zoho_crm_session->expiring_at)){
            return $zoho_crm_session;   
        }else{
            $url = $crm_config['account_domain'].'oauth/v2/token';
            $postData = [
                'client_id'=>$crm_config['client_id'],
                'client_secret'=>$crm_config['client_secret'],
                'refresh_token'=>$crm_config['refresh_token'],
                'grant_type'=>$crm_config['grant_type']
            ];
            
            $ch = curl_init(); // Create a curl handle
            curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
            curl_setopt($ch, CURLOPT_POST, FALSE);  // To set POST method true
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // To send data to the API URL
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
            $response = curl_exec($ch); // To execute the handle and get the response 
            $response = json_decode($response);
            if(isset($response->access_token)){
                $now = time();
                $ten_minutes = $now + (10 * 60);
                $startDate = date('Y-m-d H:i:s', $now);
                $endDate = date('Y-m-d H:i:s', $ten_minutes);
                $current_time = date('Y-m-d H:i:s');
                $response->expiring_at = $endDate;
                file_put_contents('../access_token.json',json_encode($response));
                return $response;
            }else{
                throw new Exception("Error Processing Request", 1);
            }
        }
    }

    public function getAllUsers(){
        $url = 'users?type=AllUsers';
        return $res = $this->sendGetRequest($url);
    }

    public function getZohoCrmRecordsListPerPage($module,$page){
        $url = $module;
        return $res = $this->sendGetRequestWithPage($url,$page);
    }

    public function getZohoCrmRecordsList($module){
        $url = $module;
        return $res = $this->sendGetRequest($url);
    }

    public function getZohoCrmSpecificRecords($module,$recordId){
        $url = $module.'/'.$recordId;
        return $res = $this->sendGetRequest($url);
    }

    // Doubtful??
    public function getZohoCrmSpecificRecords1($module,$recordId,$mod_fieldname){
        $url = $module.'/'.$recordId;
        return $res = $this->sendGetRequest1($url,$mod_fieldname);
    }

    public function getZohoCrmActiveUsers(){
        $url = 'users?type=ActiveUsers';
        return $res = $this->sendGetRequest($url);
    }

    public function updateZohoCrmRecord($module,$record_id,$postData){
        $url = $module.'/'.$record_id;
        return $res = $this->sendPutRequest($url,$postData);
    }

    public function createZohoCrmRecord($module,$postData){
        $url = $module;
        return $res = $this->sendPostRequest($url,$postData);
    }

    public function searchZohoRecord($module,$product_filter){
        // if($module == 'Production_Status'){
        //     $url = $module.'/search?criteria=(Name:equals:'.$customer_filter.')';
        //    // echo 'Accoun_Billing' .$url;
        // }
        if($module == 'Products'){
            $url = $module.'/search?criteria=(Product_Name:equals:'.rawurlencode($product_filter).')';
        }
        if($module == 'Invoices'){
            $url = $module.'/search?criteria=(Subject:equals:'.$product_filter.')';
        }
        // if($module == 'Accounts'){
        //     $url = $module.'/search?criteria=(No:equals:'.$customer_filter.')';
        // }
        if($module == 'Item_PackSize'){
            $url = $module.'/search?criteria=(Item_No:equals:'.$product_filter.')';
        }

        // if($module == 'Account_Billing'){
        //     $url = $module.'/search?criteria=(Customer_NO_with_Code:equals:'.$customer_filter.')';
        //     // echo $url;
        // }
        return $res = $this->sendGetRequest($url);
        
    } 
    
    public function searchProductRecord($module,$product_filter){
        // if($module == 'Production_Status'){
        //     $url = $module.'/search?criteria=(Name:equals:'.$customer_filter.')';
        //    // echo 'Accoun_Billing' .$url;
        // }
        if($module == 'Products')
        {
            $url = $module.'/search?criteria=(Product_Code:equals:'.rawurlencode($product_filter).')';
        }
        if($module == 'Invoices'){
            $url = $module.'/search?criteria=(Subject:equals:'.$product_filter.')';
        }
        // if($module == 'Accounts'){
        //     $url = $module.'/search?criteria=(No:equals:'.$customer_filter.')';
        // }
        if($module == 'Item_PackSize'){
            $url = $module.'/search?criteria=(Item_No:equals:'.$product_filter.')';
        }

        // if($module == 'Account_Billing'){
        //     $url = $module.'/search?criteria=(Customer_NO_with_Code:equals:'.$customer_filter.')';
        //     // echo $url;
        // }
        return $res = $this->sendGetRequest($url);
        
    }

    public function sendPostRequest($url,$postData){
        $url = 'https://www.zohoapis.eu/crm/v2.2/'.$url;
        $credentials = $this->getAccessToken();
        if(isset($credentials->access_token)){   
            $postData = json_encode($postData);
            $headers = array('Authorization: Zoho-oauthtoken '.$credentials->access_token, 'Content-type: application/json'); // return datatype
            $ch = curl_init(); // Create a curl handle
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
            curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
            curl_setopt($ch, CURLOPT_POST, FALSE);  // To set POST method true
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // To send data to the API URL
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
            return $response = curl_exec($ch); // To execute the handle and get the response 
            
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get Http Status code
        }
    }
    public function sendPutRequest($url,$postData){
        $url = 'https://www.zohoapis.eu/crm/v2/'.$url;
        $credentials = $this->getAccessToken();
        if(isset($credentials->access_token)){   
            $postData = json_encode($postData);
            $headers = array('Authorization: Zoho-oauthtoken '.$credentials->access_token, 'Content-type: application/json'); // return datatype
            $ch = curl_init(); // Create a curl handle
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
            curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
            curl_setopt($ch, CURLOPT_POST, FALSE);  // To set POST method true
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // To send data to the API URL
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
            return $response = curl_exec($ch); // To execute the handle and get the response 
            
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get Http Status code
        }
    }

    public function sendGetRequestWithPage($url, $page)
    {
      $url = 'https://www.zohoapis.eu/crm/v2.2/' . $url . '?';
      $credentials = $this->getAccessToken();
      $parameters = array();
      $parameters["page"] = $page;
      $parameters["per_page"] = 200;
      $parameters["sort_order"] = 'desc';

      foreach ($parameters as $key => $value) {
        $url = $url . $key . "=" . $value . "&";
      }
      if (isset($credentials->access_token)) {
        $headers = array('Authorization: Zoho-oauthtoken ' . $credentials->access_token, 'Content-type: application/json'); // return datatype
        $ch = curl_init(); // Create a curl handle
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
        curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
        return $response = curl_exec($ch); // To execute the handle and get the response 

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get Http Status code
      }
    }

    public function sendGetRequest($url)
    {
   echo  $url = 'https://www.zohoapis.eu/crm/v2.2/'.$url.'?';
     $credentials = $this->getAccessToken();
      
        if(isset($credentials->access_token)){ 
            $headers = array('Authorization: Zoho-oauthtoken '.$credentials->access_token, 'Content-type: application/json'); // return datatype
            $ch = curl_init(); // Create a curl handle
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
            curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API

             $response = curl_exec($ch); // To execute the handle and get the response 
             print_r($response);
           echo $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get Http Status code
        }
    }

    public function sendGetRequest1($url,$mod_fieldname)
    {
     $url = 'https://www.zohoapis.eu/crm/v2/'.$url.'?';
     $credentials = $this->getAccessToken();
      
     if(isset($credentials->access_token)){ 
            $headers = array("Authorization: Zoho-oauthtoken ".$credentials->access_token, 'X-EXTERNAL: '.$mod_fieldname, 'Content-type: application/json'); // return datatype
            $ch = curl_init(); // Create a curl handle
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
            curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
             $response = curl_exec($ch); // To execute the handle and get the response 

             $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get Http Status code
            return $response;
         
        }
    }
    
    public function getRelatedRecord($moduleApiName,$relatedListApiName,$recordId)
    {
        //{{api-domain}}/crm/v2/{{module-api-name}}/{{record-id}}/{{related-list-api-name}}
     $url = 'https://www.zohoapis.eu/crm/v2.2/'.$moduleApiName.'/'.$recordId.'/'.$relatedListApiName;
     $credentials = $this->getAccessToken();
     if(isset($credentials->access_token)){ 
            $headers = array('Authorization: Zoho-oauthtoken '.$credentials->access_token, 'Content-type: application/json'); // return datatype
            $ch = curl_init(); // Create a curl handle
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
            curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
            return $response = curl_exec($ch); // To execute the handle and get the response 

        }
    }
     //Delete specific record of module  using external id
    public function deleteSpecificRecord($id,$module)
    {
        $crm_config = include('../crm_config.php');
       $credentials = $this->getAccessToken();
        $access_token=$credentials->access_token;
       // print_r($folder_name);die();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.zohoapis.eu/crm/v2/'.$module.'/'.$id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'DELETE',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token.'',
            'X-EXTERNAL: '.$module.'.uniq_zoho_id'

          )
        ));

      echo  $response = curl_exec($curl);

        curl_close($curl);
        return $response; 

    }
 //Delete specific record of module  using record id
    public function deleteSpecificRecord1($id,$module)
    {
       $credentials = $this->getAccessToken();
        $access_token=$credentials->access_token;
       // print_r($folder_name);die();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.zohoapis.eu/crm/v2/'.$module.'/'.$id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'DELETE',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token.''

          )
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response; 

    }



// ///////////////////////////////////////////////////////////////////////////////////////
// 
//                    FILE UPLOAD FUNCTIONS
// 
// //////////////////////////////////////////////////////////////////////////////////////

    public function uploadFileToZFS($file_name){
        $base_url = "http://www.crm.eliaspartners.be/CRM/JoyCRM/synopsis/";
        $file_path = trim($base_url.$file_name);
        $credentials = $this->getAccessToken();

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.zohoapis.eu/crm/v2/files',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($file_path)),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$credentials->access_token
        ),
      ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function uploadAttachment($module_name,$record_id,$file_name){

        $base_url = "https://www.crm.eliaspartners.be/CRM/JoyCRM/descriptions/";
        $file_path = trim($base_url.$file_name);
        $credentials = $this->getAccessToken();


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.zohoapis.eu/crm/v2/'.$module_name.'/'.$record_id.'/Attachments',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($file_path)),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$credentials->access_token
        ),
      ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  $response;

    }


    public function downloadAttachment($module_name,$record_id,$file_id){

        $url = 'https://www.zohoapis.eu/crm/v2/'.$module_name.'/'.$record_id.'/Attachments/'.$file_id;
        $credentials = $this->getAccessToken();

        if(isset($credentials->access_token)){
            $headers = array('Authorization: Zoho-oauthtoken '.$credentials->access_token, 'Content-type: application/json'); // return datatype
            $ch = curl_init(); // Create a curl handle
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header
            curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
            return $response = curl_exec($ch); // To execute the handle and get the response
        }

    }











// ///////////////////////////////////////////////////////////////////////////////////////
// 
//                    FILES / WORKDRIVE FUNCTIONS
// 
// //////////////////////////////////////////////////////////////////////////////////////

    public function getAccessTokenforWorkDrive()
    {
        $crm_config = include('../crm_config.php');
        $zoho_crm_session = file_get_contents($crm_config['base_url'].'workdrive_access_token.json');
        $zoho_crm_session = json_decode($zoho_crm_session);
        $current_time = date('Y-m-d H:i:s');
        if(isset($zoho_crm_session->access_token) && ($current_time<$zoho_crm_session->expiring_at)){
            return $zoho_crm_session;   
        }else{
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://accounts.zoho.eu/oauth/v2/token',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array(
                'refresh_token ' => $crm_config['workdrive_refresh_token'],
                'client_id' => $crm_config['client_id'],
                'client_secret' => $crm_config['client_secret'],
                'redirect_uri' => 'https://www.crm.eliaspartners.be/',
                'grant_type' => 'refresh_token'
              )
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);
            curl_close($curl);
             if(isset($response->access_token)){
                    $now = time();
                    $ten_minutes = $now + (10 * 60);
                    $startDate = date('Y-m-d H:i:s', $now);
                    $endDate = date('Y-m-d H:i:s', $ten_minutes);
                    $current_time = date('Y-m-d H:i:s');
                    $response->expiring_at = $endDate;
                    file_put_contents('../workdrive_access_token.json',json_encode($response));
                    return $response;
                }else{
                    throw new Exception("Error Processing Request", 1);
                }
        }
    }

    public function uploadbuildingfiles($folder_name)
    {
        $crm_config = include('../crm_config.php');
        $credentials = $this->getAccessTokenforWorkDrive();
        $access_token=$credentials->access_token;
       // print_r($folder_name);die();
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/files',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{ 
            "data": { 
            "attributes": { 
            "name": "'.$folder_name.'", 
            "parent_id": "'.$crm_config['building_parent_id'].'" 
            }, 
            "type": "files" 
            } 
            } ',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token.'',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response; 

    }

    //Delete Workdrive File
    public function deleteFile($id)
    {
        $crm_config = include('../crm_config.php');
       $credentials = $this->getAccessTokenforWorkDrive();
        $access_token=$credentials->access_token;
       // print_r($folder_name);die();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/files/'.$id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'PATCH',
          CURLOPT_POSTFIELDS =>'{ 
            "data": { 
            "attributes": { 
            "status": "51"
            }, 
            "type": "files" 
            } 
            } ',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token.'',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response; 

    }
    // NO USE
    public function uploadTeamfiles($folder_name)
    {
       $credentials = $this->getAccessTokenforWorkDrive();
        $access_token=$credentials->access_token;
        // print_r($folder_name);die();
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/workspaces',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{ 
            "data": { 
            "attributes": { 
            "name": "'.$folder_name.'", 
            "parent_id": "1w76m9bc5bbca8682479386cf53f00060826c" 
            }, 
            "type": "workspaces" 
            } 
            } ',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token.'',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response; 

    }
    
     public function uploadbuildingfiles1($folder_name,$parent_id)
    {
        $credentials = $this->getAccessTokenforWorkDrive();
        $access_token=$credentials->access_token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/files',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{ 
            "data": { 
            "attributes": { 
            "name": "'.$folder_name.'", 
            "parent_id": "'.$parent_id.'" 
            }, 
            "type": "files" 
            } 
            } ',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token.'',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response; 

    }
    public function upload_building_attachment_multi($folder_id, $recordAttachment)
    {
      $credentials = $this->getAccessTokenforWorkDrive();
      $access_token=$credentials->access_token;
      $curl = curl_init();

      for ($i = 0; $i < count($recordAttachment['name']); $i++) {
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/upload',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_POSTFIELDS => array(
            'filename' => $recordAttachment['name'][$i], 
            'parent_id' => $folder_id, 
            'override-name-exist' => 'true', 
            'content' => new CURLFILE($recordAttachment['tmp_name'][$i])
          ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken ' . $access_token
          )
        ));

        $response = curl_exec($curl);
      }
      curl_close($curl);
      return $response;
    }

    public function upload_building_attachment($folder_id,$recordAttachment)
    {
        $credentials = $this->getAccessTokenforWorkDrive();
       $access_token=$credentials->access_token;

        $curl = curl_init();
       //echo "<pre>";print_r($recordAttachment);die();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/upload',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
	        CURLOPT_SSL_VERIFYPEER=> false,
          CURLOPT_POSTFIELDS => array(
            'filename' => $recordAttachment['name'],
            'parent_id' => $folder_id,
            'override-name-exist' => 'true',
            'content'=> new CURLFILE($recordAttachment['tmp_name'])
          ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token
          )
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    public function getAttachmentlist($workdrive_id)
    {
      //print_r($workdrive_id);die();
      $credentials = $this->getAccessTokenforWorkDrive();
      $access_token=$credentials->access_token;

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/files/' . $workdrive_id . '/files',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Zoho-oauthtoken ' . $access_token . ''
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;
    }

    // NO USE
    public function download_attachment($fileid){
        $credentials = $this->getAccessTokenforWorkDrive();
        $access_token=$credentials->access_token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://workdrive.zoho.eu/api/v1/download/'.$fileid.'",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
          'Authorization: Zoho-oauthtoken '.$access_token.''
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function createCompanyfolder($folder_name)
    {   
        $crm_config = include('../crm_config.php');
        $credentials = $this->getAccessTokenforWorkDrive();
        $access_token=$credentials->access_token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://workdrive.zoho.eu/api/v1/files',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{ 
              "data": { 
                "attributes": { 
                  "name": "'.$folder_name.'", 
                  "parent_id": "'.$crm_config['company_parent_id'].'" 
                }, 
                "type": "files" 
              } 
            } ',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '.$access_token.'',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response; 

    }

    // NO USE
    public function getrecord($moduleApiName, $relatedListApiName, $recordId)
    {

      $url = 'https://www.zohoapis.eu/crm/v2.2/' . $moduleApiName . '/' . $recordId . '/' . $relatedListApiName;
      $curl = curl_init();
      $credentials = $this->getAccessToken();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Zoho-oauthtoken ' . $credentials->access_token,
          'Cookie: 4993755637=863c018b50801b241ae42eb36c4ad84f; JSESSIONID=830196D99BD0ED437EE1C1775A5CA4A5; _zcsr_tmp=f7594532-89e3-4b2c-9c83-bcb62fc5c0d5; crmcsr=f7594532-89e3-4b2c-9c83-bcb62fc5c0d5'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    }










// ///////////////////////////////////////////////////////////////////////////////////////
// 
//                    BULKAPI FUNCTIONS
// 
// //////////////////////////////////////////////////////////////////////////////////////

    public function getAccessTokenforBulkApi(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://accounts.zoho.eu/oauth/v2/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
            'refresh_token ' => '1000.24426f0a564a0757d75ba2dc90baf264.949db7d9c388a5ce51caa9070b0ca247',
            'client_id' => '1000.B2FOMAWHMWXTX061U79W0Z88U4TWFY',
            'client_secret' => 'abcd984c5a96855344496cdb2a53ebc20e8790b1b6',
            'redirect_uri' => 'https://www.crm.eliaspartners.be/',
            'grant_type' => 'refresh_token'
          )
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $access_data = json_decode($response, true);
        return (@$access_data['access_token']);
    }
    public function getOrgZid(){

        $url = 'https://www.zohoapis.eu/crm/v2.1/org';

        $curl = curl_init();
        $credentials = $this->getAccessTokenforBulkApi();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken ' . $credentials
          )
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function uploadBulkFile($filename, $zgid){
        $url = 'https://content.zohoapis.eu/crm/v2.1/upload';
        $curl = curl_init();
        $credentials = $this->getAccessTokenforBulkApi();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken ' . $credentials,
            "X-CRM-ORG: " . $zgid,
            "feature: bulk-write"
          ),
          CURLOPT_POSTFIELDS => array('file' => '@' . $filename)


        ));

        $response = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Get Http Status code
        curl_close($curl);
        return $response;
    }
   
}
