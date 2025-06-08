<?php

use App\Core\BaseController;
use App\Http\Auth\AuthController;
use App\Http\Controllers\UserController;
use CustomRouter\Route;

// Landing page
Route::get('/ukBlog/', function () {
    $landing = new BaseController();
    $landing->renderView('landing');
});



Route::get('/ukBlog/about', function () {
    echo "New route test";
});


// register user
Route::get('/ukBlog/register', function () {
    $controller = new BaseController();
    $controller->renderView('register');
});

// Login Auth
Route::get('/ukBlog/login', function () {
    $controller = new BaseController();
    $controller->renderView('login');
});

Route::post('/ukBlog/login', function () {
    $user = new AuthController();

    if (isset($_POST['login-btn'])) {
        $email = strtolower(trim($_POST['email']));
        $password = trim($_POST['password']);
        $login_user = $user->login($email);

        if ($login_user === null) {
            $_SESSION['error'] = 'user does not exists';
            header('Location: /ukBlog/login');
            exit;
        } else {

            if ($email === strtolower($login_user['email']) && password_verify($password, $login_user['password'])) {
                $_SESSION['username'] = $login_user['username'];
                $_SESSION['email'] = $login_user['email'];
                $_SESSION['user_type'] = $login_user['user_type'];

                echo "<pre>";
                print_r($login_user);
                echo "</pre>";
                if ($_SESSION['user_type'] === 'admin') {
                    header('Location: /ukBlog/admin/dashboard'); // Redirect to admin dashboard
                    exit;
                } elseif ($_SESSION['user_type'] === 'client') {
                    header('Location: /ukBlog/client/dashboard'); // Redirect to client dashboard
                    exit;
                }
            } else {
                // TODO
                $_SESSION['error'] = 'invalid credentials...';
                header('Location: /ukBlog/login');
                exit;
            }
        }
    } else {
        $_SESSION['error'] = 'Ensure all fields are filled';
        header('Location: /ukBlog/login');
        exit;
    }
});

// Register a new user
Route::post('/ukBlog/register', function () {
    if (!isset($_POST['register-btn'])) {
        $_SESSION['error'] = 'Ensure all fields are filled...';
        header('Location: /ukBlog/register');
        exit;
    } else {
        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            $_SESSION['error'] = 'Ensure all fields are filled...';
        } else {
            $user = new UserController();
            $user_type = 'client';

            // Verify if the user exists
            $result = $user->isUser((string)$_POST['email'], (string)$_POST['password']);
            if ($result) {
                // Message to display if user exists
                $_SESSION['error'] = 'User already exists...';
            } else {
                // create a new user if not exists
                if ($user->register($_POST['username'], $_POST['email'], $_POST['password'], $user_type)) {
                    $_SESSION['success'] = 'Account created successfully!';
                } else {
                    $_SESSION['error'] = 'Failed to create this account';
                }
            }
        }
        header('Location: /ukBlog/register');
        exit;
    }
});

// Admin
Route::get('/ukBlog/admin/dashboard', [UserController::class, 'dashboard']);

// client
Route::get('/ukBlog/client/dashboard', [UserController::class, 'dashboard']);
