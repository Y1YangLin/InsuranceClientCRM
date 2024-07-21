<?php

require_once __DIR__ . "/../vendor/autoload.php";

use YiYang\Clinico\core\Application;
use YiYang\Clinico\controllers\SiteController;

$app = new Application(dirname(__DIR__));


$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/contact", [SiteController::class, "contact"]);
$app->router->post("/contact", [SiteController::class, "handleContact"]);


$app->run();

