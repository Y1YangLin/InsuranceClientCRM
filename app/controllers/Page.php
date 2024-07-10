<?php

class Page extends Controller{

    public function __construct()
    {
        
    }

    public function index()
    {

        $data = [

        ];

    
        $this->view("pages/index", $data);
    }

    public function queryPolicyHolder()
    {
        $data = [
            
        ];

        $this->view("pages/queryPolicyHolder", $data);
    }

}