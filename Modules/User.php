<?php

namespace HMS\Modules;

class User extends Database
{

    /**
     * Logs Out User
     *
     * @return void
     */
public static function  signOut(){
    unset($_SESSION);
    session_destroy();
}
}