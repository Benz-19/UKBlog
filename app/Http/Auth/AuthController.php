<?php

namespace App\Http\Auth;

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

    public function login($email, $password)
    {
        try {
            $query = "SELECT * FROM users WHERE email=:e";
            $params = [':e' => $email];
            $result = $this->db->getSingleData($query, $params);

            if ($result === null) {
                $this->db->closeConnection();
                return null;
            } else {
                return $result;
            }
        } catch (PDOException $e) {
            error_log("Database error in AuthConrtoller::login.");
        }
        return null;
    }
}
