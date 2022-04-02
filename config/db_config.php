<?php
/* Database credentials.
// define('DB_SERVER', '109.106.254.1');
// define('DB_USERNAME', 'u169097824_joy');
// define('DB_PASSWORD', "Chandra@123");
// define('DB_NAME', 'u169097824_lptool');*/
// Test server credentials

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'ligue');
// define('BASE_URL', 'http://localhost/Affiles/');
// // SQL server connection information
// $sql_details = array(
//     'user' => 'root',
//     'pass' => '',
//     'db'   => 'ligue',
//     'host' => 'localhost'
// );

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'ligue');
// define('BASE_URL', 'http://localhost/Affiles/');

// Demo server credentials
define('DB_SERVER', 'tnshxjjlmichael.mysql.db');
define('DB_USERNAME', 'tnshxjjlmichael');
define('DB_PASSWORD', 'Douchka224');
define('DB_NAME', 'tnshxjjlmichael');
define('BASE_URL', 'http://crm.liguesep.be/');

// define('BASE_URL', 'http://localhost/Affiles/');


/* Attempt to connect to MySQL database */

try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

include_once 'CrudController.php';
$crud=new crud($pdo);