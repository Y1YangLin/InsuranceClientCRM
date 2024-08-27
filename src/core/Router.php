<?php

namespace YiYang\Clinico\core;

use YiYang\Clinico\core\exception\ForbiddenException;
use YiYang\Clinico\core\exception\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [
        
    ];


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false){
            throw new NotFoundException();
        }        

        // var_dump($callback);
        // var_dump($this->routes);
        // exit;

        if (is_string($callback)){
            return Application::$app->view->renderView($callback);
        }


        // create an instance of controller class name , so call_user_func can work
        // Originally it was string then instance
        if (is_array($callback)){
            /** @var \YiYang\Clinico\core\Controller $controller */

            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            
            //set controller action
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }  

        return call_user_func($callback, $this->request, $this->response);
    
    }

}