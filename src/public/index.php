<?php

use YiYang\Clinico\core\Application;
use YiYang\Clinico\controllers\SiteController;
use YiYang\Clinico\controllers\AuthController;
use Dotenv\Dotenv;

require_once __DIR__ . "/../../vendor/autoload.php";

// load .env files
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'userClass' => \YiYang\Clinico\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]

];

// var_dump($config['userClass']);
// exit;

// return src and config
$app = new Application(dirname(__DIR__), $config);


$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/contact", [SiteController::class, "contact"]);
$app->router->post("/contact", [SiteController::class, "contact"]);

$app->router->get("/login", [AuthController::class, "login"]);
$app->router->post("/login", [AuthController::class, "login"]);
$app->router->get("/register", [AuthController::class, "register"]);
$app->router->post("/register", [AuthController::class, "register"]);

// logout suggest to use post is safe, I use get here just to test
$app->router->get("/logout", [AuthController::class, "logout"]);

//Protected Routes
$app->router->get("/profile", [AuthController::class, "profile"]);




$app->run();

