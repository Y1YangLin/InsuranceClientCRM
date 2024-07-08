<?php

declare(strict_types=1);

spl_autoload_register(function ($class){
    require __DIR__ . "/app/controllers/$class.php";
});

// 將response content type 都設成 json type
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[1] != "products"){
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;

$controller = new ProductController;

$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);