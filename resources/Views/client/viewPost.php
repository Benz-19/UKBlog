<?php
$counter = 0;
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

    <style>
        .button {
            margin-top: 25px;
            padding: 12px 20px;
            font-size: 16px;
            background-color: #0077ff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
            transition: all 0.7s ease-in-out;
        }

        .button:hover {
            background-color: rgba(34, 61, 89, 0.7);
        }
    </style>
    <title>View Post</title>
</head>

<body>
    <!-- Header -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <div class="wrapper">
        <section class="user-posts">
            <a href="/ukBlog/client/dashboard"> <button class="button">Return</button></a>
            <h1>Your Posts</h1>
            <hr>
            <?php if (isset($_SESSION['error']) || isset($_SESSION['success'])): ?>
                <div class="message" style="display: block;">
                    <?php if (isset($_SESSION['error'])): ?>
                        <p class="error"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <p class="success"><?php echo htmlspecialchars($_SESSION['success']); ?></p>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_post)): ?>
                <div style="font-size: xx-large;"><?php echo htmlspecialchars($error_post); ?></div>
            <?php else: ?>
                <?php foreach ($user_posts as $post): ?>
                    <?php $counter++; ?>
                    <div class="post-container">
                        <div class="post-title"><?php echo $counter . ') ' . htmlspecialchars($post['post_title'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="post-content">
                            <?php echo htmlspecialchars($post['post_body'], ENT_QUOTES, 'UTF-8'); ?>
                            <div>
                                <a href="/ukBlog/delete-post?id=<?php echo htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8'); ?>"> <button class="delete-btn">Delete</button></a>
                                <a href="/ukBlog/update-post?id=<?php echo htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8') ?>"> <button class="update-btn">Update</button></a>
                            </div>
                        </div>
                        <!-- Error message -->
                        <div class="post_handler">
                            <?php if (isset($_SESSION['post_handler'])): ?>
                                <p><?php echo $_SESSION['post_handler']; ?></p>
                                <p><?php unset($_SESSION['post_handler']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <!-- Footer -->
        <?php require __DIR__ . '/../layouts/footer.php'; ?>
    </div>


    <script src="public/assets/js/styles.js"></script>
    <script src="public/assets/js/header.js"></script>
</body>

</html>
