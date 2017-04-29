<?php

namespace HMS\Modules\Admin;

use HMS\Processor\{
	User,Validator
}
;

class Admin extends User{
	public function __construct(string $username,string $password){
		parent::setType('Admin');
		parent::__construct( $username,$password,parent::getType());
	}
	public function createAdmin(){
		$this->db->insert("users",[
				            "username"=>$this->getUsername(),
				            "password"=>$this->getPassword(),
				            "type"=>$this->getType()
				            ]
				            );
        return $this;
	}
}
