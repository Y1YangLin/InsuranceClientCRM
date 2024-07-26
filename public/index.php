<?php

require_once __DIR__ . "/../vendor/autoload.php";

use YiYang\Clinico\core\Application;
use YiYang\Clinico\controllers\SiteController;
use YiYang\Clinico\controllers\AuthController;

$app = new Application(dirname(__DIR__));


$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/contact", [SiteController::class, "contact"]);

$app->router->get("/login", [AuthController::class, "login"]);
$app->router->post("/login", [AuthController::class, "login"]);
$app->router->get("/register", [AuthController::class, "register"]);
$app->router->post("/register", [AuthController::class, "register"]);

$app->router->post("/contact", [SiteController::class, "handleContact"]);


$app->run();

