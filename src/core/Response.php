<?php

namespace YiYang\Clinico\core;

class Response
{

    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

}

?>