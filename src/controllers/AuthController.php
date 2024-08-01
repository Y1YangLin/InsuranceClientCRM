<?php

namespace YiYang\Clinico\controllers;

use YiYang\Clinico\core\Controller;
use YiYang\Clinico\core\Request;
use YiYang\Clinico\models\RegisterModel;

class AuthController extends Controller{

    public function login()
    {
    
        $this->setLayout("auth");

        return $this->render("login");

    }

    public function register(Request $request)
    {
        $errors = [];
        $registerModel = new RegisterModel();
        
        if($request->isPost()){
            
            $registerModel->loadData($request->getBody());
            
            // validation data from frontend
            if($registerModel->validate() && $registerModel->register()){
                return "SUCCESS";
            }


            // 以下的 validation 寫法會寫一堆 if 判斷句讓Controller 看起來比較不乾淨，比較好的寫法是用model call functons
            // if(!$firstname){
            //     $errors["firstname"] = "this field is required";
            // }

            return $this->render("register", [
                "model" => $registerModel
            ]);
        }

        $this->setLayout("auth");

        return $this->render("register", [
            "model" => $registerModel
        ]);
    }

}


?>