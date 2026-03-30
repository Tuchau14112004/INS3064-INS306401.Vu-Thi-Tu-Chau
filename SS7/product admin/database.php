<?php

/*
    Database class using Singleton pattern
    - Ensures only one database connection is created and reused
    - Uses PDO for secure database interaction
*/

class Database {
    private static $instance = null; // Store single instance of Database
    private $connection; // PDO connection object

    /*
        Private constructor:
        - Prevents direct object creation (Singleton pattern)
        - Establishes database connection using PDO
    */
    private function __construct() {
        $dsn = "mysql:host=localhost;dbname=ecommerce_db;charset=utf8mb4";
        $username = "root";
        $password = "";

        try {
            /*
                PDO configuration:
                - ERRMODE_EXCEPTION: throw exceptions when errors occur
                - FETCH_ASSOC: fetch results as associative arrays
                - EMULATE_PREPARES = false: use real prepared statements for better security
            */
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            // Create PDO connection
            $this->connection = new PDO($dsn, $username, $password, $options);

        } catch (PDOException $e) {
            /*
                Error handling:
                - Do not expose sensitive database information
                - Show generic error message for security reasons
            */
            die("Database connection failed!");
        }
    }

    /*
        Get the single instance of Database
        - Creates instance if it does not exist
        - Returns the same instance for all calls
    */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /*
        Get PDO connection
        - Used by other files to interact with database
    */
    public function getConnection() {
        return $this->connection;
    }
}
