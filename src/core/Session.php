<?php

namespace YiYang\Clinico\core;

class Session{

    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();   
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        
        foreach($flashMessages as $key => &$flashMessage){
            // mark to be removed
            $flashMessage['remove'] = true;

        }

        // send back to session variable
        $_SESSION[self::FLASH_KEY] = $flashMessages;

        // echo '<pre>';
        // var_dump($_SESSION[self::FLASH_KEY]);
        // echo '</pre>';
        // exit;

    }

    public function setFlash($key, $message){
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        // iterate over marked
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        
        foreach($flashMessages as $key => &$flashMessage){
            if($flashMessage['remove']){
                unset($flashMessages[$key]);

            }

        }

        // send back session not removed
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

}