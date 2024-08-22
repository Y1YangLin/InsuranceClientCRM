<?php

namespace YiYang\Clinico\core\db;

use YiYang\Clinico\core\Model;
use YiYang\Clinico\core\Application;

abstract class DbModel extends Model{

    // must return string table name
    abstract static public function tableName(): string;

    // return database column names
    abstract public function attributes(): array;

    //
    abstract static public function primaryKey(): string;

    public function save(){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
            VALUES(" . implode(',', $params) . ")");
        
        foreach($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;

    }

    // [email => test123@gmail.com, firstname => test]
    public static function findOne($where){
        // cannot use self but static
        // because static can call actual class self can't
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE $sql
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key => $item){
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        
        // static call created class
        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }

}