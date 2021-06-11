<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request,Response $response)
    {
        $user = new LoginForm();
        if ($request->isPost()) {
            $user->loadData($request->body());
            if ($user->validate() && $user->login()) {
                Application::$app->session->setFlash('success', '登入成功');
                $response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('login',[
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        Application::$app->session->setFlash('success', '登出成功');
        $response->redirect('/');
    }

    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()){
            $user->loadData($request->body());
            if ($user->validate() && $user->register())
            {
                Application::$app->session->setFlash('success','註冊成功');
                Application::$app->response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $user
        ]);
    }

    public function profile()
    {
        return $this->render('profile');
    }
}
