<?php

namespace Framework;
use PDO;
use PDOException;
use Exception;

class Database {
    public $conn; // Database connection

    /**
     * Constructor for Database class
     *
     * @param array $config // host, port, dbname, username, password
     */
    public function __construct($config) {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Query the Database
     * @param string $query
     * 
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $params = []) {
        try {
            $sth = $this->conn->prepare($query);
            
            // Bind named params
            foreach($params as $param => $value) {
                // Determine the parameter type
                $type = PDO::PARAM_STR; // Default to string
                if(is_int($value)) {
                    $type = PDO::PARAM_INT;
                } else if(is_bool($value)) {
                    $type = PDO::PARAM_BOOL;
                } else if(is_null($value)) {
                    $type = PDO::PARAM_NULL;
                }
                
                // Bind with the correct type
                $sth->bindValue(":{$param}", $value, $type);
            }
            
            $sth->execute();
            return $sth;
        } catch(PDOException $e) {
            throw new Exception("Query failed to execute {$e->getMessage()}");
        }
    }
    
}