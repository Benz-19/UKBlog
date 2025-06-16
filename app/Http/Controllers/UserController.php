<?php

namespace App\Http\Controllers;

use PDOException;
use App\Models\DB;
use App\Core\BaseController;
use App\Services\MessageService;

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
    public function registerView()
    {
        $controller = new BaseController();
        $controller->renderView('/auth/register');
    }

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

    public function processRegister()
    {
        if (!isset($_POST['register-btn'])) {
            MessageService::message('error',  'Ensure all fields are filled...');
            header('Location: /ukBlog/register');
            exit;
        } else {
            if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
                MessageService::message('error',  'Ensure all fields are filled...');
            } else {
                $user_type = 'client';

                // Verify if the user exists
                $result = $this->isUser((string)$_POST['email'], (string)$_POST['password']);
                if ($result) {
                    // Message to display if user exists
                    MessageService::message('error', 'User already exists...');
                } else {
                    // create a new user if not exists
                    if ($this->register($_POST['username'], $_POST['email'], $_POST['password'], $user_type)) {
                        MessageService::message('success', 'Account created successfully!');
                    } else {
                        MessageService::message('error',  'Failed to create this account');
                    }
                }
            }
            header('Location: /ukBlog/register');
            exit;
        }
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

    public function adminDashboard()
    {
        if ($_SESSION['user_type'] !== 'admin') {
            $_SESSION['user_status'] = 'logged-in';
            header('Location: /ukBlog/');
            exit;
        } else {
            $db = new DB();
            $_SESSION['user_status'] = 'logged-in';
            try {
                $query = "SELECT
                    posts.id AS post_id,
                    users.username AS author_name,
                    posts.post_title AS title,
                    posts.created_at AS created_at,
                    posts.updated_at AS updated_at
                    FROM posts
                    JOIN
                    users ON posts.author_id = users.id
                    ORDER BY posts.created_at DESC";

                $posts = $db->getAllData($query);
            } catch (PDOException $error) {
                error_log('Failure at render admin dashboard. ErrorType = ' . $error->getMessage());
                $posts = [];
            }

            require __DIR__ . '/../../../resources/Views/admin/dashboard.php';
        }
    }
}
