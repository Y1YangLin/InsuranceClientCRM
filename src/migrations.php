<?php

use YiYang\Clinico\core\Application;
use YiYang\Clinico\controllers\SiteController;
use YiYang\Clinico\controllers\AuthController;
use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";

// load .env files
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$config = [
    'userClass' => \YiYang\Clinico\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]

];

// return src and config
$app = new Application(__DIR__, $config);

$app->db->applyMigrations();

