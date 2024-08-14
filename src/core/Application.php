<?php

namespace YiYang\Clinico\core;

use YiYang\Clinico\controllers\SiteController;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Session $session;

    public static Application $app;
    public Controller $controller;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        
        $this->controller = new SiteController();
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
        
    }


    public function run()
    {
        echo $this->router->resolve();
    }

}