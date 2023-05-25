<?php

spl_autoload_register(function () {
    require_once __DIR__ . "/../vendor/autoload.php"; 
    require_once __DIR__ . "/../backend/Apllication.php";
    require_once __DIR__ . "/../backend/models/Model.php";
    require_once __DIR__ . "/../backend/models/User.php";
    require_once __DIR__ . "/../backend/controllers/Controller.php";
    require_once __DIR__ . "/../backend/controllers/IndexController.php";
    require_once __DIR__ . "/../backend/controllers/ApiController.php";
});

use Bramus\Router\Router;
use App\Application;

$app = Application::getInstance();

session_start();

// make a router here. It should replace to another file
$router = new Router();
$router->setNamespace('\App\Controllers');

$router->mount('/api', function () use ($router) {
    $router->post('/createUser', 'ApiController@createUser'); 
});

$router->get('/', 'IndexController@index');
$router->get('/dashboard', 'IndexController@dashboard');

$router->set404('/', function () {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: text/html');

    echo '<p style="width:100%; text-align:center; margin-top:15rem; font-size:7rem; font-weight:bold; color:red">
            Page not found! WTF?! 
         </p>';
});

$router->run();