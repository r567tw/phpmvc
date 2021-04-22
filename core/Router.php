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

    public function post($path, $callback)
    {
        $this->routes["POST"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if (is_string($callback)) {
            $this->response->setStatusCode(200);
            return $this->renderView($callback);
        }
        $this->response->setStatusCode(404);
        return call_user_func($callback);
    }

    public function renderView($view)
    {
        $layout = $this->layoutContent();
        $content = $this->renderOnlyView($view);
        return str_replace("{{ content }}",$content,$layout);
    }

    public function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$rootPath . "/views/{$view}.php";
        return ob_get_clean();

    }

    public function layoutContent()
    {
        ob_start();
        include_once Application::$rootPath . "/views/layouts/main.php";
        return ob_get_clean();
    }

}
