<?php
// Database connection parameters
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); 
define('DB_PASS', '');
define('DB_NAME', 'registration_db');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, 
        DB_USER, 
        DB_PASS
    );
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Optional: for testing connection
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>