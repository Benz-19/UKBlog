<?php

namespace App\Http\Auth;

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . '/../../../bootstrap.php';

use PDOException;
use App\Models\DB;
use App\Core\BaseController;
use App\Services\MessageService;

class AuthController
{
    private $db;
    public function __construct()
    {
        $db = new DB();
        $this->db = $db->connection();
    }

    // Login
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

    public function processLogin()
    {
        if (isset($_POST['login-btn'])) {
            $email = strtolower(trim($_POST['email']));
            $password = trim($_POST['password']);
            $login_user = $this->login($email);

            if ($login_user === null) {
                MessageService::message('error', 'user does not exists');
                header('Location: /ukBlog/login');
                exit;
            } else {

                if ($email === strtolower($login_user['email']) && password_verify($password, $login_user['password'])) {
                    $_SESSION['id'] = $login_user['id'];
                    $_SESSION['username'] = $login_user['username'];
                    $_SESSION['email'] = $login_user['email'];
                    $_SESSION['user_type'] = $login_user['user_type'];
                    $_SESSION['user_status'] = 'logged-in';


                    if ($_SESSION['user_type'] === 'admin') {
                        header('Location: /ukBlog/admin/dashboard'); // Redirect to admin dashboard
                        exit;
                    } elseif ($_SESSION['user_type'] === 'client') {
                        header('Location: /ukBlog/client/dashboard'); // Redirect to client dashboard
                        exit;
                    }
                } else {
                    MessageService::message('error', 'invalid credentials...');
                    header('Location: /ukBlog/login');
                    exit;
                }
            }
        } else {
            MessageService::message('error',  'Ensure all fields are filled');
            header('Location: /ukBlog/login');
            exit;
        }
    }

    public function loginView()
    {
        $_SESSION['user_status'] = '';
        $controller = new BaseController();
        $controller->renderView('/auth/login');
    }


    // Logout
    public function logoutView()
    {
        $controller = new BaseController();
        $controller->renderView('/auth/logout');
    }

    public function logout()
    {

        // Start the session if it's not already started.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset(); // Unset all session variables.

        // Delete the session cookie.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();

        // Redirect to the login page.
        header("Location: /ukBlog/");
        exit;
    }
}
