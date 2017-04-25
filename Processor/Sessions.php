<?php

namespace HMS\Processor;

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

}