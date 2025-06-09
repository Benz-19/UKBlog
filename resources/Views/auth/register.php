<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/auth.css">
    <title>Register</title>
</head>

<body>
    <!-- Header -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <div class="container">
        <!-- Content -->
        <section class="login-container">
            <h1>Register</h1>
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
            <form action="/ukBlog/register" method="post">
                <div class="email-info">
                    <label for="username" style="margin-right:12px;">username</label>
                    <input type="text" name="username" />
                </div>
                <div class="email-info">
                    <label for="email">email</label>
                    <input type="text" name="email" />
                </div>
                <div class="paswrd-info">
                    <label for="password">password</label>
                    <input type="password" name="password" />
                </div>
                <button type="submit" name="register-btn">Register</button>
                <span>Already have an account? <a href="/ukBlog/login"><i>login</i></a></span>
            </form>
        </section>
    </div>

    <!-- Footer -->
    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/ukBlog/public/assets/js/register.js"></script>
</body>

</html>
