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
    public Controller $controller;
    public Database $db;

    public function __construct($rootPath,array $config)
    {
        self::$rootPath = $rootPath;
        self::$app = $this;
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->db = new Database($config['db']);
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
}
