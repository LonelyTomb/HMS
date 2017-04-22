<?php

namespace HMS\Database;

use HMS\Database\Config;
use HMS\Database\Medoo;

class Database extends Config
{
    protected $db;
    public function __construct()
    {
        try{
            $this->db = new Medoo(
                [
                    'database_type' => 'mysql',
                    'database_name' => $this->db_params['DB_NAME'],
                    'server' => 'localhost',
                    'username' => $this->db_params['DB_USERNAME'],
                    'password' => $this->db_params['DB_PASSWORD'],
                    'charset' => 'utf8'
                ]
            );
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $this;
    }
}
