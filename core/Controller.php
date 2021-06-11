<?php
namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public $layout = 'main';
    protected array $middlewares = [];
    public string $action = '';

    public function render($view , $params=[])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function setAction(string $method)
    {
        $this->action = $method;
    }

    public function registMiddleWare(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares():array
    {
        return $this->middlewares;
    }
    
}
