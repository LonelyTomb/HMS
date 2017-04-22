<?php

namespace HMS\Processor;

class Input
{
    /**
     * Checks If data is sent
     *
     * @param string $type
     * @return void
     */
    public static function exists($type = 'post'){
        switch ($type){
            case 'post':
                return (!empty($_POST)) ? true : false;
            break ;
            case 'get':
                return (!empty($_GET)) ? true : false;
            break ;
            default :
            return false;
            break ;
        }
    }
    /**
     * Gets data from POST or GET
     *
     * @param string $item
     * @return void
     */
    public static function get($item){
        if(isset($_POST[$item]))
            return $_POST[$item];
        else if(isset($_GET[$item]))
            return $_GET[$item];
        else
            return '';
    }
}