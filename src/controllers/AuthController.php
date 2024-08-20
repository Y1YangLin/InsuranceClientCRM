<?php

namespace YiYang\Clinico\controllers;

use YiYang\Clinico\core\Application;
use YiYang\Clinico\core\Controller;
use YiYang\Clinico\core\Request;
use YiYang\Clinico\core\Response;
use YiYang\Clinico\models\LoginForm;
use YiYang\Clinico\models\User;
use YiYang\Clinico\core\middlewares\AuthMiddleware;

class AuthController extends Controller{

    public function __construct() {

        $this->registerMiddleware(new AuthMiddleware(['profile']));
    
    }

    public function login(Request $request, Response $response)
    {
    
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }

        $this->setLayout("auth");
        return $this->render("login", [
            'model' => $loginForm
        ]);

    }

    public function register(Request $request)
    {
        $errors = [];
        $user = new User();
        
        if($request->isPost()){
            
            $user->loadData($request->getBody());
            
            // validation data from frontend
            if($user->validate() && $user->save()){
                
                //make session
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');

                // dont let code below to be execute
                exit;
            }


            // 以下的 validation 寫法會寫一堆 if 判斷句讓Controller 看起來比較不乾淨，比較好的寫法是用model call functons
            // if(!$firstname){
            //     $errors["firstname"] = "this field is required";
            // }

            return $this->render("register", [
                "model" => $user
            ]);
        }

        $this->setLayout("auth");

        return $this->render("register", [
            "model" => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        
        return $this->render('profile');
    }

}


?>