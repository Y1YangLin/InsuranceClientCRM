<?php

namespace YiYang\Clinico\controllers;

use YiYang\Clinico\core\Controller;
use YiYang\Clinico\core\Application;
use YiYang\Clinico\core\Request;
use YiYang\Clinico\core\Response;
use YiYang\Clinico\models\ContactForm;

class SiteController extends Controller{


    public function home()
    {
        $params = [
            "name" => "LYY"
        ];

        return $this->render("home", $params);
    }

    public function contact(Request $request, Response $response)
    {

        $contact = new ContactForm();

        if($request->isPost()){
            //load form request data in ContactForm Model
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }

        return $this->render("contact", [
            'model' => $contact
        ]);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();

        // var_dump($body);
        // exit;

        return "Handling Submited data";
    }

}