<?php

use App\Http\Auth\AuthController;
use CustomRouter\Route;

Route::get('/ukBlog/contact', function () {
    echo "New route test";
});


Route::post('/ukBlog/login', function () {
    $user = new AuthController();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_user = $user->login($email, $password);

    if ($login_user === null) {
        $_SESSION['error'] = 'user does not exists';
    } else {
        if ($email === $login_user['email'] && password_verify($password, $login_user['password'])) {
            $_SESSION['username'] = $login_user['username'];
            $_SESSION['email'] = $login_user['email'];
            $_SESSION['user_type'] = $login_user['user_type'];


            if ($_SESSION['user_type'] === 'admin') {
                header('Location: /admin/dashboard'); // Redirect to admin dashboard
                exit;
            } elseif ($_SESSION['user_type'] === 'client') {
                header('Location: /client/dashboard'); // Redirect to client dashboard
                exit;
            }
        }
    }
});
