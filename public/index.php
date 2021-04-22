<?php

require_once __DIR__."/../vendor/autoload.php";

use app\controllers\MainController;
use app\core\Application;

$app = new \app\core\Application();

$app->router->get('/','home');

$app->router->get('/hello', 'hello');

$app->router->post('/hello', [MainController::class, 'handle']);


$app->run();