<?php

namespace YiYang\Clinico\models;

use YiYang\Clinico\core\Application;
use YiYang\Clinico\core\Model;
use YiYang\Clinico\models\User;

class LoginForm extends Model{

    public string $email = '';
    public string $password = '';
    
    // implement rules method
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    
    }

    // override
    public function labels(): array
    {
        return [
            'email' => 'Your email',
            'password' => 'Password',
        ];
    }

    public function login(){

        $user = User::findOne(['email' => $this->email]);
        
        if(!$user){
            $this->addError('email', 'User does not exist with this email');
            return false;
        }
        
        if(!password_verify($this->password, $user->password)){
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }
}