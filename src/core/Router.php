<?php

namespace YiYang\Clinico\core;

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
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }        

        // var_dump($callback);
        // var_dump($this->routes);
        // exit;

        if (is_string($callback)){
            return $this->renderView($callback);
        }


        // create an instance of controller class name , so call_user_func can work
        // Originally it was string then instance
        if (is_array($callback)){
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }  

        

        return call_user_func($callback, $this->request, $this->response);
    
    }

    public function renderView($view, $params = [])
    {

        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        // 在$layoutContent 中搜尋是否有 "{{content}}"，如果有就將其用 $viewContent替代
        return str_replace("{{content}}", $viewContent, $layoutContent);

        include_once Application::$ROOT_DIR . "/src/views/$view.php";

    }

    public function renderContent($viewContent)
    {

        $layoutContent = $this->layoutContent();

        // 在$layoutContent 中搜尋是否有 "{{content}}"，如果有就將其用 $viewContent替代
        return str_replace("{{content}}", $viewContent, $layoutContent);

        include_once Application::$ROOT_DIR . "/src/views/$view.php";

    }

    protected function layoutContent()
    {
        
        $layout = Application::$app->controller->layout;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {

        //  $params = [
            //        'name' => 'John',
            //        'age' => 30,
            //        'city' => 'New York'
            //    ];
            //將會創建 $name, $age, $city variables, 其值分別為 "John", 30, "New York"

        foreach ($params as $key => $value) {  
            $$key = $value;
        }
        
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}