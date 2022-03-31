<?php
require_once "../config/db_config.php";
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$crud->deleteAffiliation('affiliations',$id);
	header('location: '.BASE_URL.'pages/affilie.php');
	die;
}

?>