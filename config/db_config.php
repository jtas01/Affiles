<?php
// define('DB_SERVER', '109.106.254.1');
// define('DB_USERNAME', 'u169097824_joy');
// define('DB_PASSWORD', "Chandra@123");
// define('DB_NAME', 'u169097824_lptool');
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', "");
define('DB_NAME', 'coda');

try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // if($pdo){
    //     echo "Successfully Connected to ".DB_SERVER;
    // }
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>