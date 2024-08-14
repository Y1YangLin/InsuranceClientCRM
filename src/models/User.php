<?php

namespace YiYang\Clinico\models;

use YiYang\Clinico\core\DbModel;
use YiYang\Clinico\core\UserModel;

class User extends UserModel{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    //@override parent save function for password encrytion
    public function save()
    {

        $this->status = self::STATUS_INACTIVE;
        // make password encrytion
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function rules(): array
    {
        
        return [
            "firstname" => [self::RULE_REQUIRED],
            "lastname" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
                ]],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 24]],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]],
        ];
    }

    // return table attributes
    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }

    // override
    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

}