<?php
/**
 * Database Connection Class
 * Humanitarian Platform 2026
 */

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        try {
            $dsn = sprintf(
                "mysql:host=%s;port=%s;dbname=%s;charset=%s",
                DB_CONFIG['host'],
                DB_CONFIG['port'],
                DB_CONFIG['database'],
                DB_CONFIG['charset']
            );
            
            $this->connection = new PDO($dsn, DB_CONFIG['username'], DB_CONFIG['password'], DB_CONFIG['options']);
        } catch (PDOException $e) {
            if (DEBUG_MODE) {
                die("Database connection failed: " . $e->getMessage());
            } else {
                log_activity('db_connection_error', ['error' => $e->getMessage()]);
                die("Service temporarily unavailable");
            }
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // Prevent cloning
    private function __clone() {}
    
    // Prevent unserialization
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

// Helper function to get database connection
function getDB() {
    return Database::getInstance()->getConnection();
}
