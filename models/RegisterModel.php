<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{

    public string $name = '';
    public string $email = '';
    public string $password='';
    public string $password_confirm='';

    public function register()
    {
        echo 'created new user';
    }

    public function rules():array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 10]],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
            'password_confirm' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']]
        ];
    }
}
