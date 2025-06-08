<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/login.css">

    <title>Login</title>
</head>

<body>
    <!-- Header -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <div class="container">
        <!-- Content -->
        <section class="login-container">
            <h1>Login</h1>
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
            <form action="/ukBlog/login" method="post">
                <div class="email-info">
                    <label for="email">email</label>
                    <input type="text" name="email" />
                </div>
                <div class="paswrd-info">
                    <label for="password">password</label>
                    <input type="password" name="password" />
                </div>
                <button type="submit" name="login-btn">Login</button>
                <span>Don't have an account? <a href="/ukBlog/register"><i>register</i></a></span>
            </form>
        </section>
    </div>

    <!-- Footer -->
    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/ukBlog/public/assets/js/register.js"></script>
</body>

</html>
