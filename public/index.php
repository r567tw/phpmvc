<?php

require_once __DIR__."/../vendor/autoload.php";

use app\controllers\MainController;
use app\core\Application;

$app = new \app\core\Application();

$app->router->get('/',[MainController::class,'home']);

$app->router->get('/contact', [MainController::class, 'contact']);

$app->router->post('/contact', [MainController::class, 'handle']);


$app->run();