<?php

namespace App\Http\Auth;

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . '/../../../bootstrap.php';

use App\Models\DB;
use PDOException;

class AuthController
{
    private $db;
    public function __construct()
    {
        $db = new DB();
        $this->db = $db->connection();
    }

    public function login($email)
    {
        $t = new DB();
        $this->db = $t;
        try {
            $query = "SELECT * FROM users WHERE email=:e";
            $params = [':e' => $email];

            $result = $t->getSingleData($query, $params);

            if ($result === null) {
                $this->db->closeConnection();
                return null;
            } else {
                return $result;
            }
        } catch (PDOException $e) {
            error_log("Database error in AuthConrtoller::login. Error Type " . $e->getMessage());
        }
        return null;
    }
}
