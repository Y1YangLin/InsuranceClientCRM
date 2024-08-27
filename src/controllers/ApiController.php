<?php

namespace YiYang\Clinico\controllers;

use YiYang\Clinico\core\Controller;
use YiYang\Clinico\core\Request;
use YiYang\Clinico\core\Response;
use YiYang\Clinico\models\Policyholder;

class ApiController extends Controller
{

    public string $id = '';

    public function findPolicyholder(Request $request, Response $response)
    {
        
        $policyholder = new Policyholder();

        if($request->isGet()){
            $this->id = $request->getBody()['id'];
            $data = $policyholder->findOne(['id'=> $this->id]);

            if($data){
                
                header('Content-Type: application/json');

                
                
                


            }else{

            }
            
        }

        if($request->isPost()){
            // TODO
        
        }

        return $this->render('home', [

            ]
        );

    }

}