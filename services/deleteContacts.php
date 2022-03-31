<?php
require_once "../config/db_config.php";
if(isset($_GET['id'])){
	echo $id=$_GET['id'];
	$crud->deleteContacts('affiliés_contacts',$id);
	header('location: '.BASE_URL.'pages/affilie.php');
	die;
}

?>