<?php

namespace YiYang\Clinico\controllers;

use YiYang\Clinico\core\Controller;
use YiYang\Clinico\core\Request;

class AuthController extends Controller{

    public function login()
    {
    
        $this->setLayout("auth");

        return $this->render("login");

    }

    public function register(Request $request)
    {

        if($request->isPost()){
            return "Handle Submitted data";
        }

        $this->setLayout("auth");

        return $this->render("register");
    }

}