<?php

namespace app\core;

class Application
{
    public static string $rootPath;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public ?Controller $controller = null;
    public Database $db;
    public ?DBModel $user = null;
    public $userClass;

    public function __construct($rootPath,array $config)
    {
        self::$rootPath = $rootPath;
        self::$app = $this;
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->userClass = $config['userClass'];

        $primaryValue =  $this->session->get('user');
        if ($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $primaryValue =  $this->session->get('user');
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void 
    {
        $this->controller = $controller;
    }

    public function login(DBModel $user)
    {
       $this->user = $user;
       $primaryKey = $this->user->primaryKey();
       $this->session->set('user', $user->$primaryKey);
       return true;
    }

    public function logout()
    {
        $this->session->remove('user');
    }
}
