<?php
namespace YiYang\Clinico\core;


abstract class Model{

    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_MATCH = "match";
    public array $errors = [];

    public function loadData($data)
    {
        foreach($data as $key => $value){
            // check if the variable is inside the model
            if(property_exists($this, $key)){
                // 動態assign $key 中的值為var
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules() : array;

    public function validate()
    {
        foreach($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach($rules as $rule){
                $ruleName = $rule;

                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }

                // validation error of require
                if($ruleName === self::RULE_REQUIRED && !$value){
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule)
    {

        $message = $this->errorMessages()[$rule] ?? "";

        $this->errors[$attribute][] = $message;

    }


    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => "This is field is required",
            self::RULE_EMAIL => "This field must be valid email address",
            self::RULE_MIN => "Min length of this field must be {min}",
            self::RULE_MAX => "Max length of this field must be {max}",
            self::RULE_MATCH => "This field must be the same as {match}",
        ];

    }
}