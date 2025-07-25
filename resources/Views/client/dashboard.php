<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/styles.css">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/header.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 20px;
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        select,
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fdfdfd;
            transition: border 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #0077ff;
        }

        button {
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

        button:hover {
            background-color: rgba(34, 61, 89, 0.7);
        }

        .message {
            margin-top: 15px;
            font-size: 14px;
            color: green;
        }
    </style>
    <title>Update Post</title>
</head>

<body>
    <!-- Header -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <div class="wrapper">
        <!-- Content -->
        <section class="dash-container">
            <h1>Welcome <?php echo ucfirst($_SESSION['username']); ?></h1>

            <div>
                <?php if (!isset($_SESSION['update_post'])): ?>
                    <!-- Create Post section -->
                    <?php require __DIR__ . '/createPost.php'; ?>
                <?php else: ?>
                    <!-- Update Post section-->
                    <?php require __DIR__ . '/updatePost.php'; ?>
                    <?php unset($_SESSION['update_post']); ?>
                <?php endif; ?>
            </div>

        </section>

        <!-- Footer -->
        <?php require __DIR__ . '/../layouts/footer.php'; ?>
    </div>

    <!-- JS -->
    <script src="/ukBlog/public/assets/js/header.js"></script>
    <script src="/ukBlog/public/assets/js/styles.js"></script>


</body>

</html>
