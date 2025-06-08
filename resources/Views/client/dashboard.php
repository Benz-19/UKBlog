<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/styles.css">
    <link rel="stylesheet" href="/ukBlog/public/assets/css/header.css">
    <title>Client Dashboard</title>
</head>

<body>
    <!-- Header -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <!-- Content -->
    <h1>Welcome Client</h1>
    <?php echo $_SESSION['user_status']; ?>
    <!-- Footer -->
    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>
