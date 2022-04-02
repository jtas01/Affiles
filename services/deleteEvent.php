<?php
require_once "../config/db_config.php";
include('../classes/GoogleCrmClient.php');
$crmObj = new GoogleCrmClient();
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$eventid=$_GET['eventid'];
	$calendar_id="primary";
	 $crmObj->DeleteCalendarEvent($eventid,$calendar_id);   
	$crud->deleteEvent('meeting',$id);
	header('location: '.BASE_URL.'pages/events.php');
	die;
}

?>