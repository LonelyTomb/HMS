<?php

namespace HMS\Modules\Patient;

use HMS\Processor\{
	User,Validator
}
;

class Patient extends User{
	protected $patientId;
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
	public function __construct(){
		parent::__construct();
	}
	/**
	 * Creates Patient
	 *
	 * @return void
	 */
	public function createPatient(string $surname,string $otherNames,string $address,string $phoneNumber,string $email){
		parent::setType('Patient');
		parent::setUserId('patients','PAT');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		$this->setAddress($address);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);

		$this->db->insert("users",[
				            "username"=>parent::getUserId(),
				            "password"=>parent::getPassword(),
				            "type"=>$this->getType()
				            ]
				            );
		$this->db->insert("patients",[
							"PatientId"=>parent::getUserId(),
							"Surname"=>parent::getSurname(),
							"OtherNames"=>parent::getOtherNames(),
							"Address"=>$this->getAddress(),
							"PhoneNumber"=>parent::getPhoneNumber(),
							"Email"=>parent::getEmail()
		]);
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
