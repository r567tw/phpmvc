<?php

namespace app\core;

use app\core\exceptions\NotFoundException;

class Router
{

    protected array $routes = [];
    public Request $request;
    public Response $response;
    protected const DEFAULT_LAYOUT = 'main';

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
            throw new NotFoundException();
        }
        if (is_string($callback)) {
            $this->response->setStatusCode(200);
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->next();
            }
        }
        
        $this->response->setStatusCode(200);
        return call_user_func($callback, $this->request,$this->response);
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
        $layout = self::DEFAULT_LAYOUT;
        if (isset(Application::$app->controller)){
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$rootPath . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

}
