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
    public static function catch(string $item){
        return $_POST['$item'] ?? $_GET['$item'] ?? '';
    }
    /**
     * Checks if a variable exists in $_GET array
     *
     * @param string $item
     * @return bool
     */
    public static function getExists(string $item):bool{
        return isset($_GET[$item]) ? TRUE : FALSE;
    }
}