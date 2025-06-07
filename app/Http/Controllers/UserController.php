<?php

namespace App\Http\Controllers;

use App\Models\DB;
use App\Core\BaseController;

class UserController extends BaseController
{

    private $db;

    public function __construct()
    {
        $db = new DB();
        $this->db  = $db;
    }

    // Registers a new user
    public function register() {}

    // Render dashboard
    public function dashboard()
    {
        if (!isset($_SESSION['user_type'])) {
            http_response_code(403);
            echo "Unauthorized access.";
            return;
        }

        $type = $_SESSION['user_type'];
        if ($type === 'admin') {
            $this->renderView('admin/dashboard');
        } elseif ($type === 'client') {
            $this->renderView('client/dashboard');
        } else {
            http_response_code(404);
            echo "Dashboard not found.";
        }
    }
}
