<?php

require_once __DIR__."/../vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\MainController;
use app\core\Application;

$app = new Application();

$app->router->get('/',[MainController::class,'home']);
$app->router->get('/contact', [MainController::class, 'contact']);
$app->router->post('/contact', [MainController::class, 'handle']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->run();