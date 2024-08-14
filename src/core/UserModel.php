<?php

namespace YiYang\Clinico\core;

abstract class UserModel extends DbModel{

    abstract public function getDisplayName(): string;

}