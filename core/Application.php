<?php

namespace app\core;

class Application
{

    public Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router(new Request());
    }

    public function run()
    {
        $this->router->resolve();
    }
}
