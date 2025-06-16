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
        $_SESSION['user_status'] = '';

        if ($_SESSION['user_status'] !== 'logged-in') {
            try {
                $db = new DB();

                $query = "SELECT
                          posts.id AS post_id,
                          posts.post_title,
                          posts.post_body,
                          posts.created_at,
                          posts.updated_at,
                          users.username AS author_name
                      FROM posts
                      JOIN users ON posts.author_id = users.id
                      ORDER BY posts.created_at DESC";

                $posts = $db->getAllData($query);
            } catch (PDOException $error) {
                error_log('Failed to fetch posts in BaseController::processLanding. Error: ' . $error->getMessage());
                $posts = []; // Fallback to empty array if query fails
            }

            require __DIR__ . '/../../resources/Views/pages/landing.php';
        }
    }
}
