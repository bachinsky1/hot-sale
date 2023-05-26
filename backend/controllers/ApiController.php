<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\User;

class ApiController extends Controller
{
    public function __construct() 
    {
        parent::__construct();
    }

    // static method is better for bramus router
    public static function createUser()
    {
        $user = new User();

        $result = $user->store($_POST);

        if (!!$result) {
            $_SESSION['userCreated'] = true;
        }

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(['result' => $result], JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_IGNORE);
    }

}