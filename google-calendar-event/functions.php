<?php 
function RefreshAccessToken($client_id, $redirect_uri, $client_secret, $refresh_token){
	$url = 'https://oauth2.googleapis.com/token?';			

	$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&refresh_token='. $refresh_token . '&grant_type=refresh_token&Content-Type: application/x-www-form-urlencoded';
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
/*https://accounts.google.com/o/oauth2/v2/auth?
  client_id=115840719204-jb1b890rrgftbo0okc6ia8j25rahddh4.apps.googleusercontent.com&
  response_type=code&access_type=offline&&
  state=state_parameter_passthrough_value&
  scope=https://www.googleapis.com/auth/calendar.events&
  redirect_uri=http://localhost/ligueCRM/index.php*/
  /*https://oauth2.googleapis.com/token?client_id=115840719204-jb1b890rrgftbo0okc6ia8j25rahddh4.apps.googleusercontent.com&client_secret=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&code=4/0AX4XfWhqZWr05wJbsc0hrami0jxgZkG72R3bWFoILNXqlYp5Tps2pJYOfIJqqtIYkNPD6A&access_type=offline&
  redirect_uri=http://localhost/ligueCRM/index.php&
  grant_type=refresh_token*/
function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
	$url = 'https://oauth2.googleapis.com/token?';			

	$curlPost = 'client_id=' . $client_id .'&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
	$ch = curl_init();		
	curl_setopt($ch, CURLOPT_URL, $url);		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
	curl_setopt($ch, CURLOPT_POST, 1);		
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
	 $data = json_decode(curl_exec($ch), true);
	 print_r($data);
	$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
	if($http_code != 200) 
		throw new Exception('Error : Failed to receieve access token');
	
	return $data;
}

function GetUserCalendarTimezone($access_token){
	$url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';

	$ch = curl_init();		
	curl_setopt($ch, CURLOPT_URL, $url_settings);		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
	$data = json_decode(curl_exec($ch), true);
	echo $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
	if($http_code != 200) 
		throw new Exception('Error : Failed to get timezone');

	return $data['value'];
} 

function CreateCalendarEvent($calendar_id, $summary, $all_day, $event_time, $event_timezone, $access_token) {
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
	print_r($curlPost);
	$ch = curl_init();		
	curl_setopt($ch, CURLOPT_URL, $url_events);		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
	curl_setopt($ch, CURLOPT_POST, 1);		
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
	$data = json_decode(curl_exec($ch), true);
	echo $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
	if($http_code != 200)
		throw new Exception('Error : Failed to create event');

	return $data['id'];
}
function CalendarEventList($calendar_id, $access_token) {
	$url = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';
 	$ch = curl_init(); // Create a curl handle
   // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set curl handle header 
    curl_setopt($ch, CURLOPT_URL, $url); // Third party API URL
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // To set SSL Verifier false
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // To set return response from the API
	$data = json_decode(curl_exec($ch), true);
	echo $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
	if($http_code != 200)
		throw new Exception('Error : Failed to create event');

	return $data;
}
