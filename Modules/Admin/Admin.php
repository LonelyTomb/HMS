<?php

namespace HMS\Modules\Admin;

use HMS\Processor\{
	User,Validator
}
;

class Admin extends User{
	public function __construct(){
		parent::__construct();
	}
	public function createAdmin(string $username,string $password){
		parent::setUsername($username);
        parent::setPassword($password);
        parent::setType('Admin');
		$this->db->insert("users",[
				            "username"=>parent::getUsername(),
				            "password"=>parent::getPassword(),
				            "type"=>parent::getType()
				            ]
				            );
        return $this;
	}
}
