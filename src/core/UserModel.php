<?php

namespace YiYang\Clinico\core;
use YiYang\Clinico\core\db\DbModel;

abstract class UserModel extends DbModel{

    abstract public function getDisplayName(): string;

}