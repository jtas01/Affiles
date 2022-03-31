<?php 
 
// Load the database configuration file 
include_once '../../db_config.php'; 
 
// Fetch records from database 
   $sq = "SELECT cd.*, m.*, SUM(tr_amount) AS amount FROM coda_data AS cd 
                INNER JOIN members AS m 
                ON m.id = cd.member_id WHERE  m.status = 1 Group By m.id";;
    $res = $pdo->query($sq); 
  $count=$res->rowCount();
if($count>0) {
    $delimiter = ","; 
    $filename = "reports_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
   $fields = array('Title', 'Intitule','Account Number', 'Addresse', 'CP', 'Localite', 'Divers', 'Dons', 'Cumulvst', 'Communication');  
  fputcsv($f, $fields, $delimiter); 
             while($row1 = $res->fetch()){
              
        $lineData = array($row1['titre'], $row1['intitule'], $row1['account_number'], $row1['addresse'], $row1['cp'], $row1['localite'], $row1['diver'], $row1['amount'], $row1['cumulvst'], $row1['communication']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>