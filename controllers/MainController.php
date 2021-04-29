<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

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