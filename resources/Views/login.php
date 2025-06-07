<?php

use App\Models\DB;

$db = new DB();

$result = $db->getSingleData("SELECT * FROM users WHERE
                            user_type=:admin", [':admin' => 'admin']);

if ($result !== null) {
} else {
    echo "no";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/login.css">
    <title>Login</title>
</head>

<body>
    <section class="login-container">
        <h1>Login</h1>
        <form action="/ukBlog/login" method="post">
            <div class="email-info">
                <label for="email">email</label>
                <input type="text" name="email" />
            </div>
            <div class="paswrd-info">
                <label for="password">password</label>
                <input type="text" name="password" />
            </div>
            <button type="submit" name="login-btn">Login</button>
            <span>Don't have an account? <a href="/ukBlog/register"><i>register</i></a></span>
        </form>
    </section>
</body>

</html>
