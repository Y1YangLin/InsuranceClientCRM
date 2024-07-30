<?php

namespace YiYang\Clinico\controllers;

use YiYang\Clinico\core\Controller;
use YiYang\Clinico\core\Application;
use YiYang\Clinico\core\Request;

class SiteController extends Controller{


    public function home()
    {
        $params = [
            "name" => "LYY"
        ];

        return $this->render("home", $params);
    }

    public function contact()
    {
        return $this->render("contact");
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();

        // var_dump($body);
        // exit;

        return "Handling Submited data";
    }

}