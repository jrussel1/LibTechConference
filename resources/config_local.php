<?php
    define('DB_TYPE', 'mysql');
    define('DB_HOST', '192.254.234.179');
    define('DB_USER', 'jrussell_dev');
    define('DB_PASSWORD', 'no1more2pass3words');
    define('DB_DATABASE', 'jrussell_Lib');

    function pdo_connect() {
        // Set DSN
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instance
        try{
            $conn = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
            return $conn;
        }
        // Catch any errors
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }