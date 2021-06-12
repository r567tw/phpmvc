<?php

namespace app\models;

use r567tw\phpmvc\Application;
use r567tw\phpmvc\Model;

class LoginForm extends Model
{

    public string $email = '';
    public string $password='';

    public function login()
    {
        $user = User::findOne(['email'=> $this->email]);
        if (!$user || !password_verify($this->password,$user->password)){
            $this->addError('email','該用戶不存在或密碼錯誤');
            return false;
        }
        return Application::$app->login($user);
    }

    public function rules():array
    {
        return [
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }
}
