
<?php

define('GOOGLE_CLIENT_ID', '115840719204-jb1b890rrgftbo0okc6ia8j25rahddh4.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URI', 'http://localhost/ligueCRM/index.php');

//Include Google Client Library for PHP autoload file

require 'google-api/vendor/autoload.php';


//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId(GOOGLE_CLIENT_ID);

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret(GOOGLE_CLIENT_SECRET);

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri(GOOGLE_REDIRECT_URI);

//
$google_client->addScope('email');

$google_client->addScope('profile');
$google_client->addScope('https://www.googleapis.com/auth/calendar');
$google_client->addScope('https://www.googleapis.com/auth/calendar.events');
$google_client->addScope(Google_Service_Calendar::CALENDAR);


$google_client->setAccessType('offline');
$google_client->setApprovalPrompt('force');

//start session on web page
session_start();
if(isset($_GET["code"]))
{
//It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
if(!isset($token['error']))
{

  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
   $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();


  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
}
}
?>
