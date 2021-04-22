<?php

namespace app\core;

class Router
{

    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
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
            $this->response->setStatusCode(404);
            return 'Not Found';
        }
        
        return call_user_func($call);
    }
}
