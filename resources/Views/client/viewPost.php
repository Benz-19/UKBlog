<?php

use App\Http\Controllers\PostController;

if ($_SESSION['user_type'] !== 'client') {
    header('Location: ukBlog/');
    exit;
}
if (!isset($_SESSION['id'])) {
    header('Location: ukBlog/login');
    exit;
}
$post = new PostController();
$user_posts = $post->getPost($_SESSION['id']);
$user_posts = null;
if (empty($user_posts) || !isset($user_posts)) {
    $_SESSION['error'] = 'No Posts Yet...';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/styles.css">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/header.css">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/auth.css">

    <title>Document</title>
</head>

<body>
    <!-- Header -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <section class="user-posts">
        <h1>Your Posts</h1>
        <hr>
        <div class="message" style="display: none;">
            <p class="error">
                <?php if (isset($_SESSION['error'])): ?>
                    <?php echo $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </p>
            <p class="success">
                <?php if (isset($_SESSION['success'])): ?>
                    <?php echo $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
            </p>
        </div>
        <div class="post-container">
            <div class="post-title">Hello</div>
            <div class="post-content">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores deserunt aspernatur, fugit at officiis nihil. Eveniet sint illum deserunt repellat! Eligendi ut cum in omnis facilis libero amet, nam numquam?</div>
        </div>
        <hr>
    </section>

    <!-- Footer -->
    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="public/assets/js/styles.js"></script>
    <script src="public/assets/js/header.js"></script>
</body>

</html>
