<?php

namespace YiYang\Clinico\core;

class View{

    public string $title = '';

    public function renderView($view, $params = [])
    {

        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        
        // var_dump(dirname(__FILE__));
        // exit;

        // 在$layoutContent 中搜尋是否有 "{{content}}"，如果有就將其用 $viewContent替代
        return str_replace("{{content}}", $viewContent, $layoutContent);

    }

    public function renderContent($viewContent)
    {

        $layoutContent = $this->layoutContent();

        // 在$layoutContent 中搜尋是否有 "{{content}}"，如果有就將其用 $viewContent替代
        return str_replace("{{content}}", $viewContent, $layoutContent);

    }

    protected function layoutContent()
    {

        $layout = Application::$app->layout;

        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
        
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