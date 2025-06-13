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

    private function getPostID()
    {
        return $_GET['id'];
    }

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
        $_SESSION['user_status'] = 'logged-in';
        $user_id = $_SESSION['id'];
        $user_posts = $this->getPost($user_id);

        $error_post = '';
        if (empty($user_posts)) {
            $error_post = 'No Posts Yet...';
        }

        // Include the view and pass variables
        require __DIR__ . '/../../../resources/Views/client/viewPost.php';
    }

    // Delete the client post(s) if exists
    public function deleteClientPosts()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['post_handler'] = 'Failed to delete post...';
            header('Location: /ukBlog/view-posts');
            exit;
        } else {
            try {
                $delete_post_id = $_GET['id'];
                $db = new DB();
                $query = "DELETE FROM posts WHERE id=:id";
                $params = [":id" => $delete_post_id];
                $db->execute($query, $params);
                $_SESSION['post_handler'] = 'Successfully deleted the post...';
                header('Location: /ukBlog/view-posts');
                exit;
                (new BaseController())->renderView('client/viewPost');
            } catch (PDOException $e) {
                error_log('Failed to delete client post at PostController::deleteClientPosts. ErrorType = ' . $e->getMessage());
                $_SESSION['post_handler'] = 'Something went wrong!!!';
                header('Location: /ukBlog/view-posts');
                exit;
            }
        }
    }

    //Update the client post(s) if exists
    public function updateClientPosts($post = [])
    {
        try {
            $db = new DB();
            $query = "UPDATE posts SET post_title=:title, post_body=:body";
            $params = [
                ':title' => $post['title'],
                ':body' => $post['body']
            ];
            $db->execute($query, $params);
        } catch (PDOException $error) {
            error_log('Failed to insert the new update into the database. Check PostController::UpdateClientPost. ErrorType = ' . $error->getMessage());
        }
    }
    public function getClientPosts()
    {
        $postId = 4;
        echo $postId;
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        if (!isset($postId)) {
            $_SESSION['post_handler'] = 'Failed to update post...';
            header('Location: /ukBlog/view-posts');
            exit;
        } else {
            try {
                $db = new DB();
                $update_post_id = $postId;
                $query = "SELECT * FROM posts WHERE id=:id";
                $params = [':id' => $update_post_id];
                $result = $db->getSingleData($query, $params);

                if (empty($result)) {
                    $_SESSION['post_handler'] = 'No data was reteived to update';
                    header('Location: /ukBlog/view-posts');
                    exit;
                }

                $body = htmlspecialchars(trim($result['post_body']));
                $title = htmlspecialchars(trim($result['post_title']));
                $_SESSION['post_handler'] = 'Updated the post successfully!';
                $_SESSION['update_post'] = true;
                require_once __DIR__ . '/../../../resources/Views/client/dashboard.php';
            } catch (PDOException $e) {
                error_log('Failed to update client posts at PostController::updateClientPosts. ErrorType = ' . $e->getMessage());
                $_SESSION['post_handler'] = 'Something went wrong!!!';
                header('Location: /ukBlog/view-posts');
                exit;
            }
        }
    }
}
