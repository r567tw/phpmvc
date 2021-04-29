<?php

namespace app\core;

class Application
{
    public static string $rootPath;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;

    public function __construct()
    {
        self::$rootPath = dirname(__DIR__);
        self::$app = $this;
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
