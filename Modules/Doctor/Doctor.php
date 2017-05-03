<?php

namespace HMS\Modules\Doctor;

use HMS\Processor\{
	User,Validator
}
;

class Doctor extends User{
	protected $doctorId;
	protected $daysAvailable;
	/**
	 * Doctor Constructor
	 *
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $phoneNumber
	 * @param string $email
	 * @param string $daysAvailable
	 */
    public function __construct(){
		parent::__construct();
	}
	/**
	 * Creates Doctor
	 *
	 * @return void
	 */
	public function createDoctor(string $surname,string $otherNames,string $phoneNumber,string $email,string $daysAvailable){
		parent::setType('Doctor');
		parent::setUserId('doctors','DOC');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);
		$this->daysAvailable = $daysAvailable;

		$this->db->insert("users",[
				            "username"=>parent::getUserId(),
				            "password"=>parent::getPassword(),
				            "type"=>$this->getType()
				            ]
				            );
		$this->db->insert('doctors',[
							"DoctorId"=>parent::getUserId(),
							"Surname"=>parent::getSurname(),
							"OtherNames"=>parent::getOtherNames(),
							"PhoneNumber"=>parent::getPhoneNumber(),
							"Email"=>parent::getEmail(),
							"DaysAvailable"=>$this->daysAvailable
		]);
        return $this;
	}

	public function getDoctors(){
		$doctors = $this->db->select('doctors','*');
		return $doctors;
	}
}
