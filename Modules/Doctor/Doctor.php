<?php

namespace HMS\Modules\Doctor;

use HMS\Processor\{
	User,Validator
}
;

class Doctor extends User{
	protected $specialization;
	/**
	 * Doctor Constructor
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
	 * Creates Doctor
	 *
	 * @return void
	 */
	public function createDoctor(){
		$this->db->insert("Users",[
				            "username"=>$this->getUsername(),
				            "password"=>$this->getPassword(),
				            "type"=>$this->getType(),
							"Surname"=>parent::getSurname(),
							"OtherNames"=>parent::getOtherNames(),
							"Address"=>$this->getSpecialization(),
							"PhoneNumber"=>parent::getPhoneNumber(),
							"Email"=>parent::getEmail()
				            ]
				            );
        return $this;
	}
	/**
	 * Set specialization
	 *
	 * @param string $specialization
	 * @return void
	 */
	public function setSpecialization(string $specialization){
		$this->specialization = $specialization;
	}
	/**
	 * Get specialization
	 *
	 * @return string
	 */
	public function getSpecialization():string{
		return $this->specialization;
	}
}
