<?php

use App\Core\BaseController;
use App\Http\Auth\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Services\MessageService;
use CustomRouter\Route;

// Landing page
Route::get('/ukBlog/', function () {
    $landing = new BaseController();
    $_SESSION['user_status'] = '';
    if ($_SESSION['user_status'] !== 'logged-in') {
        $_SESSION['user_status'] = ''; // will determine if a user is signed in or not
        $landing->renderView('/pages/landing');
    }
});



Route::get('/ukBlog/about', function () {
    echo "New route test";
});


/**
 *  USER AUTHENTICATION
 * user could be an admin/client
 */

// register a user
Route::get('/ukBlog/register', function () {
    $controller = new BaseController();
    $controller->renderView('/auth/register');
});

// Login user
Route::get('/ukBlog/login', function () {
    $_SESSION['user_status'] = '';
    $controller = new BaseController();
    $controller->renderView('/auth/login');
});

// logout Auth
Route::get('/ukBlog/logout', function () {
    $controller = new BaseController();
    $controller->renderView('/auth/logout');
});

// Login user
Route::post('/ukBlog/login', function () {
    $user = new AuthController();

    if (isset($_POST['login-btn'])) {
        $email = strtolower(trim($_POST['email']));
        $password = trim($_POST['password']);
        $login_user = $user->login($email);

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
});

// Register a new user (client/admin)
Route::post('/ukBlog/register', function () {
    if (!isset($_POST['register-btn'])) {
        MessageService::message('error',  'Ensure all fields are filled...');
        header('Location: /ukBlog/register');
        exit;
    } else {
        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            MessageService::message('error',  'Ensure all fields are filled...');
        } else {
            $user = new UserController();
            $user_type = 'client';

            // Verify if the user exists
            $result = $user->isUser((string)$_POST['email'], (string)$_POST['password']);
            if ($result) {
                // Message to display if user exists
                MessageService::message('error', 'User already exists...');
            } else {
                // create a new user if not exists
                if ($user->register($_POST['username'], $_POST['email'], $_POST['password'], $user_type)) {
                    MessageService::message('success', 'Account created successfully!');
                } else {
                    MessageService::message('error',  'Failed to create this account');
                }
            }
        }
        header('Location: /ukBlog/register');
        exit;
    }
});

/**
 * Admin FUNCTIONALITIES
 */

// route to admin dashboard
Route::get('/ukBlog/admin/dashboard', [UserController::class, 'dashboard']);


/**
 * CLIENT FUNCTIONALITIES
 */
Route::get('/ukBlog/client/dashboard', [UserController::class, 'dashboard']);

// View Posts -  client
Route::get('/ukBlog/view-posts', [PostController::class, 'viewClientPosts']);

/**
 * TODO: ADD the id for the posts so that you can capture it to determine
 *       which post to delete or update
 */
// Delete Posts -  client
Route::get('/ukBlog/delete-post', [PostController::class, 'deleteClientPosts']);

// Update Posts -  client
Route::get('/ukBlog/update-post', [PostController::class, 'getClientPosts']);
Route::post('/ukBlog/update-post', [PostController::class, 'saveUpdatedPost']);
// Creates a new post - client
Route::post('/ukBlog/create-post', function () {

    if (isset($_POST['sendPost'])) {

        if (isset($_POST['title']) && isset($_POST['body'])) {
            $post = [
                'author_id' => $_SESSION['id'],
                'title' => $_POST['title'],
                'body' => $_POST['body']
            ];

            $new_post = new PostController();
            $post_result = $new_post->setPost($post);
            MessageService::message('success', 'Post was successful');
            if ($post_result) {
                header('Location: /ukBlog/client/dashboard');
                exit;
            }
        } else {
            MessageService::message('error', 'title or body was not added to post');
        }
    } else {
        MessageService::message('error', 'Failed to send post...');
    }
});
