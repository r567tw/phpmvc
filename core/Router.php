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
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if (is_string($callback)) {
            $this->response->setStatusCode(200);
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        $this->response->setStatusCode(404);
        return call_user_func($callback, $this->request);
    }

    public function renderView($view,$params = [])
    {
        $layout = $this->layoutContent();
        $content = $this->renderOnlyView($view,$params);
        return str_replace("{{ content }}",$content,$layout);
    }

    public function renderOnlyView($view,$params)
    {
        foreach ($params as $key => $param) {
            $$key = $param;
        }
        ob_start();
        include_once Application::$rootPath . "/views/{$view}.php";
        return ob_get_clean();
    }

    public function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$rootPath . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

}
