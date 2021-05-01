<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $user = new RegisterModel();
        if ($request->isPost()){
            $user->loadData($request->body());
            if ($user->validate() && $user->register())
            {
                return 'success';
            }
            // var_dump($user->errors);
            // var_dump($request->body());
        }
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $user
        ]);
    }
}
