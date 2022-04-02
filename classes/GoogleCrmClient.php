<?php
Class GoogleCRMClient { 

    public function getAccessToken1(){ 
        $crm_config = include('../crm_config.php');
        $ligue_crm_session = file_get_contents($crm_config['base_url'].'access_token.json');
        $ligue_crm_session = json_decode($ligue_crm_session);
        $current_time = date('Y-m-d H:i:s');

        if(isset($ligue_crm_session->access_token) && ($current_time<$ligue_crm_session->expires_in)){
             $ligue_crm_session;   
            
              return $ligue_crm_session;
        }else{
            $url = 'https://oauth2.googleapis.com/token?';          

            $curlPost = 'client_id=' . $crm_config['client_id'] . '&redirect_uri=' .  $crm_config['redirect_url'] . '&client_secret=' .$crm_config['client_secret'] . '&refresh_token='.  $crm_config['refresh_token'] . '&grant_type='.$crm_config['grant_type'].'&Content-Type: application/x-www-form-urlencoded&access_type=offline';
            $url = 'https://oauth2.googleapis.com/token';
           $ch = curl_init();       
            curl_setopt($ch, CURLOPT_URL, $url);        
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
            curl_setopt($ch, CURLOPT_POST, 1);      
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);    
             $response = json_decode(curl_exec($ch));
          
               //   print_r($response);
        
            if(isset($response->access_token)){
                $now = time();
                $ten_minutes = $now + (10 * 60);
                $startDate = date('Y-m-d H:i:s', $now);
                $endDate = date('Y-m-d H:i:s', $ten_minutes);
                $current_time = date('Y-m-d H:i:s');
                $response->expires_in = $endDate;
                file_put_contents('../access_token.json',json_encode($response));
               return $response;
            }else{
                throw new Exception("Error Processing Request", 1);
            }
        }
    }

   function RefreshAccessToken($client_id, $redirect_uri, $client_secret, $refresh_token){
    $url = 'https://www.googleapis.com/oauth2/v3/token';            

    $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&refresh_token='. $refresh_token . '&grant_type=refresh_token';
    $ch = curl_init();      
    curl_setopt($ch, CURLOPT_URL, $url);        
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
    curl_setopt($ch, CURLOPT_POST, 1);      
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);    
     $data = json_decode(curl_exec($ch), true);
    $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);      
    if($http_code != 200) 
    throw new Exception('Error : Failed to receieve access token');
    
    return $data;
}
public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) { 
    $url = 'https://www.googleapis.com/oauth2/v3/token';            

    $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
    $ch = curl_init();      
    curl_setopt($ch, CURLOPT_URL, $url);        
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
    curl_setopt($ch, CURLOPT_POST, 1);      
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);    
    $data = json_decode(curl_exec($ch), true);
    $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);      
    if($http_code != 200) 
        throw new Exception('Error : Failed to receieve access token');
    
    return $data;
}

public function GetUserCalendarTimezone(){
    $credentials = $this-> getAccessToken1();
   $access_token = $credentials->access_token;
    $url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';

    $ch = curl_init();      
    curl_setopt($ch, CURLOPT_URL, $url_settings);       
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$access_token));   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    $data = json_decode(curl_exec($ch), true);
     $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);     
    if($http_code != 200) 
        throw new Exception('Error : Failed to get timezone');

    return $data['value'];
} 

public function CreateCalendarEvent($calendar_id, $summary, $all_day, $event_time, $event_timezone) {
    $credentials = $this-> getAccessToken1();

    $access_token = $credentials->access_token;
    $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';

    $curlPost = array('summary' => $summary,'description' => $event_time['description']);
    //$curlPost = array();
    if($all_day == 1) { 
        $curlPost['start'] = array('date' => $event_time['start_time']);
        $curlPost['end'] = array('date' => $event_time['end_time']);    
        $curlPost['attendees'] = array(
            array('email' => $event_time['email'])
        );
        
    }else {
        $curlPost['start'] = array('dateTime' => $event_time['start_time'], 'timeZone' => $event_timezone);
        $curlPost['end'] = array('dateTime' => $event_time['end_time'], 'timeZone' => $event_timezone);
        $curlPost['attendees'] = array(
            array('email' => $event_time['email'])
        );
        
    }
    $ch = curl_init();      
    curl_setopt($ch, CURLOPT_URL, $url_events);     
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
    curl_setopt($ch, CURLOPT_POST, 1);      
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json')); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));   
    $data = json_decode(curl_exec($ch), true);
     $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);     
    if($http_code != 200)
        throw new Exception('Error : Failed to create event');

    return $data['id'];
}
public function UpdateCalendarEvent($calendar_id, $summary, $all_day, $event_time, $event_timezone, $event_id) {
    $credentials = $this-> getAccessToken1();
    $access_token = $credentials->access_token;
    $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/' . $event_id;

    $curlPost = array('summary' => $summary,'description' => $event_time['description']);
    //$curlPost = array();
    if($all_day == 1) { 
        $curlPost['start'] = array('date' => $event_time['start_time']);
        $curlPost['end'] = array('date' => $event_time['end_time']);    
        $curlPost['attendees'] = array(
            array('email' => $event_time['email'])
        );
        
    }else {
        $curlPost['start'] = array('dateTime' => $event_time['start_time'], 'timeZone' => $event_timezone);
        $curlPost['end'] = array('dateTime' => $event_time['end_time'], 'timeZone' => $event_timezone);
        $curlPost['attendees'] = array(
            array('email' => $event_time['email'])
        );
        
    }
    $ch = curl_init(); // Create a curl handle
    curl_setopt($ch, CURLOPT_URL, $url_events);     
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');     
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json')); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));   
    $data = json_decode(curl_exec($ch), true);
     $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);     
    if($http_code != 200)
        throw new Exception('Error : Failed to update event');

    return $data['id'];
}
public function CalendarEventList($calendar_id,$eventid) {
     $credentials = $this-> getAccessToken1();
    $access_token = $credentials->access_token;
    $url = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/'.$eventid;
    $ch = curl_init(); // Create a curl handle
   // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
    curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json')); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
    $data = json_decode(curl_exec($ch), true);
    echo $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);     
    if($http_code != 200)
        throw new Exception('Error : Failed to create event');

    return $data;
}
public function DeleteCalendarEvent($event_id, $calendar_id) {
     $credentials = $this-> getAccessToken1();
     $access_token = $credentials->access_token;
        $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/' . $event_id;

        $ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $url_events);     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));     
        $data = json_decode(curl_exec($ch), true);
      echo  $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if($http_code != 204) 
            throw new Exception('Error : Failed to delete event');
}   
}
