<?php

namespace YiYang\Clinico\core\middlewares;

use YiYang\Clinico\core\Application;
use YiYang\Clinico\core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware{

    public array $actions = [];


    /**
     * @param array $actions
     */

    public function __construct(array $actions = []) {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()){

            // action is empty means theres no controller method to do
            // method in url matchs in $action means Guest is accessing protected pages
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }

}