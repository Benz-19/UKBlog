<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/header.css">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/displayPost.css">

    <title>ukBlog</title>
</head>

<body>
    <!-- Header -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <div class="wrapper">
        <!-- Content -->
        <?php require __DIR__ . '/renderPosts.php'; ?>

        <!-- Footer -->
        <?php require __DIR__ . '/../layouts/footer.php'; ?>
    </div>

    <script src="/ukBlog/public/assets/js/styles.js"></script>
</body>

</html>
