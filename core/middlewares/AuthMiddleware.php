<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\exceptions\ForbiddenException;
use app\core\middlewares\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions =[];

    public function __construct(array $methods=[])
    {
        $this->actions = $methods;   
    }

    public function next()
    {
        if (Application::isGuest()){
            if (empty($this->actions) || in_array(Application::$app->controller->action,$this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}
