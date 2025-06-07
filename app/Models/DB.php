<?php

namespace App\Models;

use PDO;
use PDOException;


class DB
{
    private $conn;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        try {

            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};port={$config['port']};charset={$config['charset']}";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $error) {
            error_log("DB Connection Failed: " . $error->getMessage());

            $this->conn = null; // Ensure connection is null on failure
        }
    }

    public function closeConnection()
    {
        $this->conn = null;
    }

    public function connection() //establishes a connection
    {
        if (!isset($this->conn)) {
            $db = new DB();
            $this->conn = $db;
            return $this->conn;
        }

        return $this->conn;
    }

    /**
     * Executes sql commands like SELECT, DELETE, UPDATE
     * @param string $query is the sql query
     * @param array $params is an associative array for the prepared statement
     */

    public function execute(string $query, $params = [])
    {
        if (!$this->conn) {
            throw new PDOException("Database connection not established to execute this query.");
        }
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    public function getSingleData(string $query, $params = [])
    {
        if (!$this->conn) {
            throw new PDOException("Database connection not established, failed to retrieve single data");
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null; // Return null if no row is found
    }
}
