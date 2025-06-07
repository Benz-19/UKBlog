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
        $email = $_POST['email'];
        $password = $_POST['password'];
        $login_user = $user->login($email);

        echo $password;

        if ($login_user === null) {
            $_SESSION['error'] = 'user does not exists';
        } else {
            if ($email === $login_user['email'] && $password === $login_user['password']) {
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
                echo "invalid credentials...";
                $_SESSION['error'] = 'invalid credentials...';
            }
        }
    } else {
        $_SESSION['error'] = 'Ensure all fields are filled';
    }
});

// Admin
Route::get('/ukBlog/admin/dashboard', [UserController::class, 'dashboard']);

// client
Route::get('/ukBlog/client/dashboard', [UserController::class, 'dashboard']);
