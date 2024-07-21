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
        $method = $this->request->getMethod();
        
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


        // 
        if (is_array($callback)){
            $callback[0] = new $callback[0]();
        }  

        // var_dump($callback);
        // exit;

        return call_user_func($callback);
    
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
        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        var_dump($name);
        exit;

        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/$view.php";
        return ob_get_clean();
    }

}