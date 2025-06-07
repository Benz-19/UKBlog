<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/landing.css">
    <title>ukBlog</title>
</head>

<body>
    <nav>
        <ul>
            <li>
                <a href="/ukBlog">
                    <h3 class="logo">
                        ukBlog
                    </h3>
                </a>
            </li>
            <div class="nav-links">
                <a href="/ukBlog">
                    <li>Home</li>
                </a>
                <a href="/ukBlog/about">
                    <li>About</li>
                </a>
            </div>
            <div class="top-btn">
                <a href="/ukBlog/login">
                    <button class="login">Login</button>
                </a>
                <a href="/ukBlog/register">
                    <button class="register">register</button>
                </a>
            </div>
        </ul>

        <div class="menu-btn">
            <i class="fas fa-bars open-menu"></i>
            <i class="fas fa-times close-menu hidden"></i>
        </div>

        <div class="menu-btn-content hidden">
            <ul>
                <li>
                    <a href="/ukBlog">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/ukBlog/about">
                        About
                    </a>
                </li>
                <li>
                    <a href="/ukBlog/login">
                        <button class="login">Login</button>
                    </a>
                </li>
                <li>
                    <a href="/ukBlog/register">
                        <button class="register">register</button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="main-container">
        <h1>Landing</h1>
    </section>

    <script src="/ukBlog/public/assets/js/landing.js"></script>
</body>

</html>
