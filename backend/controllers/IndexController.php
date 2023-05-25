<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\User;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function index()
    {
        $_SESSION['userCreated'] = false;

        $user = new User();

        $allUsers = $user->getAll();

        include __DIR__ . "/../views/main.php";
    }

    public static function dashboard()
    {
        if ($_SESSION['userCreated'] == false) {
            header('Location: /');
        }

        echo "Dashboard";
    }
}