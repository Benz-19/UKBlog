<?php

namespace App\Http\Controllers;

use App\Models\DB;
use App\Core\BaseController;
use PDOException;

class UserController extends BaseController
{

    private $db;

    public function __construct()
    {
        $db = new DB();
        $this->db  = $db;
    }

    // Verify if the user exists
    public function isUser($email, $password)
    {
        $t = new DB();
        try {
            $query = "SELECT * FROM users WHERE email=:email";
            $params = [':email' => $email];

            $result = $t->getSingleData($query, $params);
            return $result;
            if (empty($result) || $result === null) {
                return false;
            } else {
                if ($result['password'] === $password) {
                    return true;
                } elseif (password_verify($password, $result['password'])) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        } catch (PDOException $error) {
            error_log("Failed to register this new user... Error Type: " . $error->getMessage());
            return false;
        }
        return false;
    }

    // Registers a new user
    public function register($username, $email, $password, $user_type)
    {
        try {
            $query = "INSERT INTO users(username, email, password, user_type) VALUES (:uname, :email, :pass, :uTyp)";
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $params = [
                ':uname' => strtolower(trim($username)),
                'email' => strtolower(trim($email)),
                ':pass' => $hashed_password,
                ':uTyp' => strtolower(trim($user_type))
            ];

            $this->db->execute($query, $params);
            return true;
        } catch (PDOException $error) {
            error_log("Failed to register this new user... Error Type: " . $error->getMessage());
            return false;
        }
        return false;
    }

    // Render dashboard
    public function dashboard()
    {
        if (!isset($_SESSION['user_type'])) {
            http_response_code(403);
            header('Location: /ukBlog/');
            exit;
            return;
        }
        $type = $_SESSION['user_type'];
        if ($type === 'admin') {
            $_SESSION['user_status'] = 'logged-in';
            $this->renderView('admin/dashboard');
        } elseif ($type === 'client') {
            $_SESSION['user_status'] = 'logged-in';
            $this->renderView('client/dashboard');
        } else {
            http_response_code(404);
            echo "Dashboard not found.";
        }
    }
}
