<?php

namespace YiYang\Clinico\core;

use YiYang\Clinico\controllers\SiteController;

class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public View $view;

    // might be none
    public ?DbModel $user;
    public Session $session;

    public static Application $app;
    public ?Controller $controller = null;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        
        // $this->setController(new SiteController());

        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);
        
        $primaryValue = $this->session->get('user');

        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }
        

    }


    public function run()
    {

        try{
            echo $this->router->resolve();
        }catch(\Exception $e){
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    
    }

    public function setController(\YiYang\Clinico\core\Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function getController(): \YiYang\Clinico\core\Controller
    {
        return $this->controller;
    }

    public function login(DbModel $user)
    {
        // save user in the session
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        // give $primaryValue the value in user->primaryKey variable
        $primaryValue = $user->{$primaryKey};

        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        // user is guest
        return !self::$app->user;
    }

}