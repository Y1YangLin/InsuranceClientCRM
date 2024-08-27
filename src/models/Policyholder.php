<?php

namespace YiYang\Clinico\models;

use YiYang\Clinico\core\db\DbModel;

class Policyholder extends DbModel
{
    public $id;

    public static function tableName(): string
    {
        return "policyholders";
    }

    public static function primaryKey(): string
    {
        return "id";
    }

    public function attributes(): array
    {
        return [
            'id', 
        ] ;
    }

    public function rules(): array
    {
        return [


        ];
    }

}