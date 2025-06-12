<?php

namespace App\Http\Controllers;

use PDOException;
use App\Models\DB;
use ErrorException;
use App\Core\BaseController;
use App\Http\Auth\AuthController;

class PostController
{
    private $db;
    public function __construct()
    {
        $db = new DB();
        $this->db = $db->connection();
        if (!$this->db) {
            error_log('Failed to establish a db connection at PostController construct');
        }
    }

    public function setPost($postData = [])
    {
        $t = new DB();
        $this->db = $t;
        try {
            $query = "INSERT INTO posts(author_id, post_title, post_body) VALUES (:author, :title, :body)";
            $params = [
                ':author' => $postData['author_id'],
                ':title' => $postData['title'],
                ':body' => $postData['body']
            ];

            $this->db->execute($query, $params);
            return true;
        } catch (PDOException $error) {
            error_log('Failed to insert a new post at PostController::setPost method. Error Type: ' . $error->getMessage());
            return false;
        }
        return false;
    }

    public function getPost($author_id)
    {
        $t = new DB();
        $this->db = $t;
        try {
            $query = "SELECT * FROM posts where author_id=:id";
            $params = [':id' => $author_id];
            $result =  $this->db->getAllData($query, $params);
            return $result;
        } catch (PDOException $error) {
            error_log('Failed to insert a new post at PostController::setPost method. Error Type: ' . $error->getMessage());
            return false;
        }
        return false;
    }

    // Displays the client post(s) if exists
    public function viewClientPosts()
    {
        // Access control
        if (!isset($_SESSION['id'])) {
            header('Location: /ukBlog/login');
            exit;
        }

        if ($_SESSION['user_type'] !== 'client') {
            header('Location: /ukBlog/');
            exit;
        }

        $user_id = $_SESSION['id'];
        $user_posts = $this->getPost($user_id);

        $error_post = '';
        if (empty($user_posts)) {
            $error_post = 'No Posts Yet...';
        }

        // Include the view and pass variables
        require_once __DIR__ . '/../../../resources/Views/client/viewPost.php';
    }
}
