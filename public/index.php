<?php

require_once __DIR__."/../vendor/autoload.php";
use app\core\Application;

$app = new \app\core\Application();

$app->router->get('/',function(){
    return "hello my framework";
});

$app->router->get('/user', function () {
    return "hello user router";
});

$app->run();