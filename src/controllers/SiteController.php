<?php

namespace YiYang\Clinico\controllers;

use YiYang\Clinico\core\Application;

class SiteController{


    public function home()
    {
        $params = [
            "name" => "LYY"
        ];

        return Application::$app->router->renderView("home", $params);
    }

    public function contact()
    {
        return Application::$app->router->renderView("contact");
    }

    public function handleContact()
    {
        return "Handling Submited data";
    }

}