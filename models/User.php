<?php

namespace app\models;

use app\core\DBModel;

class User extends DBModel
{

    public string $name = '';
    public string $email = '';
    public string $password='';
    public string $password_confirm='';

    public function table_name(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'name', 
            'email',
            'password' 
        ];
    }

    public function register()
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return $this->save();
    }

    public function rules():array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 10]],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED],
            'password_confirm' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']]
        ];
    }
}
