<?php
require_once "../config/db_config.php";
include('../classes/GoogleCrmClient.php');
$crmObj = new GoogleCrmClient();
if(isset($_POST['cid'])){
    $affilie_id=$_POST['affilie_id'];
    $cid=$_POST['cid'];
    $fromdate=(isset($_POST['fromdate'])) ? $_POST['fromdate'] : '';
    $todate=(isset($_POST['todate'])) ? $_POST['todate'] : '';
  //  $meetingObj = array();
  //  $timezone='+01:00';
 
   
    $meetingArr['affilie_id'] = $affilie_id;
    $meetingArr['affilie_contact_id'] = $cid;
    $event_title = $meetingArr['object'] = (isset($_POST['title'])) ? $_POST['title'] : '';
    $meetingArr['end_date'] = $todate;  
    $meetingArr['start_date'] =  $fromdate;
    //$meetingArr['subject'] =(isset($_POST['next_action'])) ? $_POST['next_action'] : '';
      $meeting_remarks = $meetingArr['remarks'] = (isset($_POST['meeting_remarks'])) ? $_POST['meeting_remarks'] : '';

  
       $user_timezone = $crmObj->GetUserCalendarTimezone();
      $calendar_id = 'primary';
     
      
      $email = 'chandra@gmail.com';
    //  echo   $fromdate = $_POST['fromdate'];
      // echo  $todate = $_POST['todate'];
    // Event starting & finishing at a specific time
    $full_day_event = 0; 
    $event_time = [ 'start_time' =>$fromdate.':00', 'end_time' => $todate.':00', 'description'=>$meeting_remarks, 'email'=>$email ];

     $data = $crmObj->CreateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $user_timezone);
  
  $meetingArr['affilie_meeting_id'] = $data;

  if($_POST['type']=='add'){

      $crud->create('meeting', $meetingArr);      
        echo 'add';
        exit;
  }else if($_POST['type']=='edit'){
      $meetid=$_POST['id'];   
    
      if ($meetid){
     $data = $crmObj->UpdateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $user_timezone);   
        $crud->updateMeeting('meeting', $meetingArr, $meetid);          
        echo 'update';
        exit;
      }
  }

}
