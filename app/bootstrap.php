<?php

    require_once "config/Config.php";

    spl_autoload_register(function($className){
        require_once "libraries/" . $className .".php";
    });
