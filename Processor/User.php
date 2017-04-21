<?php

namespace HMS\Processor;

use HMS\Processor\Sessions;
use HMS\Database\Database;

class User extends Database
{

    /**
     * Logs Out User
     *
     * @return void
     */
public static function  signOut(){
    Sessions::destroy();
}
}