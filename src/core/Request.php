<?php

namespace YiYang\Clinico\core;

class Request
{

    public function getPath()
    {
        
        $path = $_SERVER["REQUEST_URI"] ?? "/";

        // 以 ? 對uri 進行切割，並分離出 substring
        $position = strpos($path, "?");

        
        if ($position === false){
            return $path;
        }

        return substr($path, 0, $position);

    }

    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

}