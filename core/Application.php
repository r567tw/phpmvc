<?php

namespace app\core;

class Application
{
    public static string $rootPath;
    public static Application $app;
    public Router $router;

    public function __construct()
    {
        self::$rootPath = dirname(__DIR__);
        self::$app = $this;
        $this->router = new Router();
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
