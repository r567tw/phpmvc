<?php
namespace app\controllers;

use app\core\Application;

class MainController
{

    public static function handle()
    {
        return 'handle post data';
    }

    public static function contact()
    {
        return Application::$app->router->renderView('Contact');
    }

    public static function home()
    {
        return Application::$app->router->renderView('Home',[
            'name' => 'Jimmy'
        ]);
    }
}