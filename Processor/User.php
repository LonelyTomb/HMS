<?php

namespace HMS\Processor;

use HMS\Processor\Sessions;
use HMS\Database\Database;

class User extends Database
{
    public function __construct(){
        parent::__construct();
    }
    public function getA(){
        return $this->db->get("patients","*",["id"=>1]);
    }
    /**
     * Logs Out User
     *
     * @return void
     */
public static function  signOut(){
    Sessions::destroy();
}
}