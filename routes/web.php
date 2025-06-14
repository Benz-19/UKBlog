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
 * CLIENT ROUTES
 * Handles client-side operations like viewing, updating, and creating posts.
 */

// register a user
Route::get('/ukBlog/register', [UserController::class, 'registerView']);

// Login user
Route::get('/ukBlog/login', [AuthController::class, 'loginView']);

// logout Auth
Route::get('/ukBlog/logout', [AuthController::class, 'logoutView']);

// Login user
Route::post('/ukBlog/login', [AuthController::class, 'processLogin']);

// Register a new user (client/admin)
Route::post('/ukBlog/register', [UserController::class, 'processRegister']);

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

// Delete Posts -  client
Route::get('/ukBlog/delete-post', [PostController::class, 'deleteClientPosts']);

// Update Posts -  client
Route::get('/ukBlog/update-post', [PostController::class, 'getClientPosts']);
Route::post('/ukBlog/update-post', [PostController::class, 'saveUpdatedPost']);
// Creates a new post - client
Route::post('/ukBlog/create-post', [PostController::class, 'createPost']);
