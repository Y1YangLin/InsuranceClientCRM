<?php

namespace YiYang\Clinico\core;

abstract class DbModel extends Model{

    // must return string table name
    abstract public function tableName(): string;

    public function save(){

    }

}