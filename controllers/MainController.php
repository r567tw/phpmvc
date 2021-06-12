<?php
namespace app\controllers;

use r567tw\phpmvc\Application;
use r567tw\phpmvc\Controller;
use r567tw\phpmvc\Request;

class MainController extends Controller
{

    public function handle(Request $request)
    {
        $body = Application::$app->request->body();
        return $this->render('result',[
            'name' => $body['name'],
            'message' => $body['message']
        ]);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function home()
    {
        return $this->render('home', [
            'name' => 'Jimmy (From Controller)'
        ]);
    }
}