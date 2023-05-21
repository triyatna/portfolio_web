<?php

/* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
<<<<<<< HEAD
define('DB_NAME', 'personal_profile');
define('DOMAIN_APP', 'http://localhost/mypersonal/');
=======
define('DB_NAME', 'spanel');
define('DOMAIN_APP', 'http://localhost/spanel/');
>>>>>>> 184b74b795c81e5f5c3db2442b508d8a84c345b1

/* Attempt to connect to MySQL database */
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $GLOBALS['conn'] = $pdo;
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($db, "utf8mb4");
} catch (PDOException $e) {
    $GLOBALS['e'] = $e;
    die("ERROR: Could not connect. " . $e->getMessage());
}

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$domain = DOMAIN_APP;
$admin = $domain . 'admin/';

date_default_timezone_set("Asia/Jakarta");
