<?php

namespace app\core;

class Router
{

    protected array $routes = [];
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }


    public function get($path, $callback)
    {
        $this->routes["GET"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $call = $this->routes[$method][$path] ?? false;
        if ($call === false){
            echo '404 Not Found';
            exit;
        }
        echo call_user_func($call);
    }
}
