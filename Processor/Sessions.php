<?php

namespace HMS\Processor;

Class Sessions
{
    /**
     * Initialize Session
     *
     * @return void
     */
    public static function Init()
    {
        ini_set('session.cookie_httponly', 1);
        ini_set("session.hash_function", "sha512");
        ini_set("session.hash_bits_per_character", 5);
        ini_set("session.use_strict_mode", 1);
        #ini_set("session.cookie_domain", ".HMS");
        #ini_set("session.cookie_secure", 1); //SSL
        ini_set("session.entropy_file", "/dev/urandom");
        ini_set("session.entropy_length", "512");
        session_name('pd');
        session_start();
        session_regenerate_id(true);
    }

    public static function destroy()
    {
        unset($_SESSION);
        session_destroy();
    }

}