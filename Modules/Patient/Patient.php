<?php

namespace HMS\Modules\Patient;

use HMS\Processor\{
	User,Validator
}
;

class Admin extends User{
	protected $address;
	/**
	 * Patient Constructor
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $address
	 * @param string $phoneNumber
	 * @param string $email
	 */
	public function __construct(string $username,string $password,string $surname,string $otherNames,string $address,string $phoneNumber,string $email){
		parent::setType('Patient');
		parent::__construct($username,$password,parent::getType());
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		$this->setAddress($address);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);
	}
	/**
	 * Creates Patient
	 *
	 * @return void
	 */
	public function createPatient(){
		$this->db->insert("Users",[
				            "username"=>$this->getUsername(),
				            "password"=>$this->getPassword(),
				            "type"=>$this->getType(),
							"Surname"=>parent::getSurname(),
							"OtherNames"=>parent::getOtherNames(),
							"Address"=>$this->getAddress(),
							"PhoneNumber"=>parent::getPhoneNumber(),
							"Email"=>parent::getEmail()
				            ]
				            );
        return $this;
	}
	/**
	* Sets User Address
	     *
	     * @param string $address
	     * @return void
	     */
	    public function setAddress(string $address){
		$this->address = $address;
	}

	/**
	* Gets User Address
	     *
	     * @return string
	     */
	    public function getAddress():string{
		return $this->address;
	}
}
