<?php

namespace YiYang\Clinico\core;

abstract class DbModel extends Model{

    // must return string table name
    abstract public function tableName(): string;

    // return database column names
    abstract public function attributes(): array;

    public function save(){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
            VALUES(" . implode(',', $params) . ")");
        
        foreach($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        // echo '<pre>';
        // var_dump($statement, $params, $attributes);
        // echo '</pre>';
        // exit;

        $statement->execute();
        return true;

    }

    // [email => test123@gmail.com, firstname => test]
    public function findOne($where){
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

    public function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }

}