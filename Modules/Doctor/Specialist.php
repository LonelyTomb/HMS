<?php

namespace HMS\Modules\Doctor;

use HMS\Processor\{
	User,Validator
}
;

class Specialist extends User{
	protected $specialistId;
	protected $daysAvailable;
	/**
	 * Doctor Constructor
	 *
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $address
	 * @param string $phoneNumber
	 * @param string $email
	 * @param string $daysAvailable
	 */
    public function __construct(){
		parent::__construct();
	}
	/**
	 * Creates Specialist
	 *
	 * @return void
	 */
	public function createSpecialist(string $surname,string $otherNames,string $phoneNumber,string $email,string $daysAvailable){
		parent::setType('Specialist');
        parent::setUserId('specialists','SPE');
        parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);
		$this->daysAvailable = $daysAvailable;
		parent::setStatus($daysAvailable);


		$this->db->insert("users",[
				            "username"=>parent::getUserId(),
				            "password"=>parent::getPassword(),
				            "type"=>$this->getType()
				            ]
				            );
		$this->db->insert('specialists',[
							"SpecialistId"=>parent::getUserId(),
							"Surname"=>parent::getSurname(),
							"OtherNames"=>parent::getOtherNames(),
							"PhoneNumber"=>parent::getPhoneNumber(),
							"Email"=>parent::getEmail(),
							"DaysAvailable"=>$this->daysAvailable,
							"Status"=>parent::getStatus()
		]);
        return $this;
	}
	public function getSpecialists(){
		$doctors = $this->db->select('specialists','*');
		return $doctors;
	}
}
