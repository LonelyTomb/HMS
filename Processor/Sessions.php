<?php

namespace HMS\Processor;

use HMS\Processor\Functions;
Class Sessions
{
    /**
     * Initialize Session
     *
     * @return void
     */
    public static function init()
    {
        // ini_set('session.cookie_httponly', 1);
        // ini_set("session.hash_function", "sha512");
        // ini_set("session.hash_bits_per_character", 5);
        // ini_set("session.use_strict_mode", 1);
        #ini_set("session.cookie_domain", ".HMS");
        #ini_set("session.cookie_secure", 1); //SSL
        // session_name('pd');
        session_start([
            'name'=>'pd',
            'cookie_httponly'=> 1,
            'hash_function'=>'sha512',
            "use_strict_mode"=>1,

        ]);
        session_regenerate_id();
    }
    /**
     * Destroy Session
     *
     * @return void
     */
    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
    /**
     * Checks if $_SESSION variable exists
     *
     * @param string $item
     * @return bool
     */
    public static function exists(string $item):bool{
        if(isset($_SESSION[$item])){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Get item from sessions
     *
     * @param string $items
     * @return void
     */
    public static function get(string $items){
        $items = explode('/',$items);
        if(count($items) == 1){
            if(isset($_SESSION[end($items)])) return false;
        }else{
            foreach($items as $item){
                $result = Functions::get($_SESSION,$item);
            }
            return $result;
        }
    }

}