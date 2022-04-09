<?php
require_once "../config/db_config.php";
if(isset($_GET['id'])){
	 $id=$_GET['id'];

	$crud->deleteUser('users',$id);
	header('location: '.BASE_URL.'pages/user.php');
	die;
}

?>