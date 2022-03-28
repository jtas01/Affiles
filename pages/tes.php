<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../classes/ZohoCrmClient.php";

$crmObj = new ZohoCrmClient();
//$id = $_POST['id'];
$id = "379971000001465031";
// Get Building  data
 $building = $crmObj->getZohoCrmSpecificRecords("Accounts",$id);
echo '<pre>';
print_r($building);



?>