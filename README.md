# ukBlog

ukBlog is a PHP-based blogging platform that allows users to register, log in, and manage blog posts. The application supports both admin and client user roles, with separate dashboards and functionalities for each. The project uses a custom routing system, MVC-like structure, and PDO for database interactions.

## Features

- User registration and authentication (admin/client roles)
- Admin dashboard for managing all posts
- Client dashboard for creating, updating, and deleting their own posts
- Responsive UI with custom CSS
- Session-based messaging for user feedback
- Modular code structure for easy maintenance

## Project Structure

```
.
├── app/
│   ├── Core/                # Base controllers and core logic
│   ├── Http/                # Controllers for Auth and main app logic
│   ├── Models/              # Database and model classes
│   └── Services/            # Service classes (e.g., messaging)
├── config/
│   └── database.php         # Database configuration
├── migrations/              # Database migration files
├── public/
│   └── assets/              # CSS, JS, images
├── resources/
│   ├── Views/               # Blade-like PHP views
│   └── ...                  # Layouts, pages, posts, etc.
├── routes/
│   └── web.php              # Route definitions
├── vendor/                  # Composer dependencies
├── .env                     # Environment variables
├── bootstrap.php            # Bootstrap file
├── composer.json            # Composer config
├── index.php                # Entry point
└── ...
```

## Getting Started

### Prerequisites

- PHP 8.0+
- Composer
- MySQL or compatible database
- Web server (e.g., Apache, Nginx, or WAMP/XAMPP)

### Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/yourusername/ukBlog.git
    cd ukBlog
    ```

2. **Install dependencies:**
    ```sh
    composer install
    ```

3. **Set up environment variables:**
    - Copy `.env.example` to `.env` and update database credentials:
      ```
      DB_HOST=localhost
      DB_NAME=your_db_name
      DB_USERNAME=your_db_user
      DB_PASSWORD=your_db_password
      ```

4. **Set up the database:**
    - Import the migration files in `migrations/` into your MySQL database.

5. **Configure your web server:**
    - Point your document root to the project directory.
    - Ensure `index.php` is the entry point.

6. **Start the server (for development):**
    ```sh
    php -S localhost:8000
    ```
    Then visit [http://localhost:8000/ukBlog/](http://localhost:8000/ukBlog/)

## Usage

- Register as a new user (client or admin).
- Log in to access your dashboard.
- Clients can create, update, and delete their own posts.
- Admins can view and manage all posts.

## Folder Overview

- **Controllers:** Business logic for authentication, posts, and users ([app/Http/Controllers/](app/Http/Controllers/))
- **Models:** Database connection and queries ([app/Models/DB.php](app/Models/DB.php))
- **Views:** HTML/PHP templates for UI ([resources/Views/](resources/Views/))
- **Routes:** URL routing ([routes/web.php](routes/web.php))
- **Services:** Helper services like messaging ([app/Services/MessageService.php](app/Services/MessageService.php))
- **Assets:** CSS, JS, and images ([public/assets/](public/assets/))

## Customization

- Update styles in [public/assets/css/](public/assets/css/)
- Edit views in [resources/Views/](resources/Views/)
- Add new routes in [routes/web.php](routes/web.php)

## License

This project is open-source and available under the [MIT License](LICENSE).

---

**Note:** For production, ensure you secure your `.env` file and configure proper permissions.
