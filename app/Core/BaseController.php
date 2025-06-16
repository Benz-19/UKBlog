<?php

namespace App\Core;

use App\Models\DB;
use PDOException;

class BaseController
{
    public function renderView($view, $data = [])
    {
        extract($data);
        $path = dirname(__DIR__, 2) . "/resources/Views/$view.php";

        if (file_exists($path)) {
            require $path;
        } else {
            http_response_code(500);
            echo "View not found: $path";
        }
    }

    public function processLanding()
    {
        // $landing = new BaseController();
        $_SESSION['user_status'] = '';
        if ($_SESSION['user_status'] !== 'logged-in') {
            $_SESSION['user_status'] = ''; // will determine if a user is signed in or not
            // $landing->renderView('/pages/landing');
            try {
                $db = new DB();
                $query  = "SELECT * FROM posts WHERE id=?";
                $params = [4];
                $posts = $db->getAllData($query, $params);
                $posts;
            } catch (PDOException $error) {
                error_log('Failed to read the fetch posts at BaseController::processLanding. ErrorType = ' . $error->getMessage());
            }
            require __DIR__ . '/../../resources/Views/pages/landing.php';
        }
    }
}
