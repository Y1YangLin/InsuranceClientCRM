<?php

namespace YiYang\Clinico\core;

use YiYang\Clinico\core\Application;
use YiYang\Clinico\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = "main";
    public string $action = "";

    /**
     * @var \YiYang\Clinico\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

}