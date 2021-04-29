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
        return $this->render('Result',[
            'name' => $body['name'],
            'message' => $body['message']
        ]);
    }

    public function contact()
    {
        return $this->render('Contact');
    }

    public function home()
    {
        return $this->render('Home', [
            'name' => 'Jimmy (From Controller)'
        ]);
    }
}