<?php

namespace HMS\Modules\Doctor;

use HMS\Processor\{
	User
};

/**
 * Class Doctor
 * @package HMS\Modules\Doctor
 */
class Doctor extends User
{
	protected $doctorId;
	protected $daysAvailable;

	/**
	 * Doctor Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Doctor Creation function
	 *
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $phoneNumber
	 * @param string $email
	 * @param string $daysAvailable
	 * @return void
	 */
	public function createDoctor(string $surname, string $otherNames, string $phoneNumber, string $email, string $daysAvailable)
	{
		parent::setType('Doctor');
		parent::setUserId('doctors', 'DOC');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);
		$this->daysAvailable = $daysAvailable;
		parent::setStatus($daysAvailable);

		$this->db->insert("users", [
				'username' => parent::getUserId(),
				'password' => parent::getPassword(),
				'type' => $this->getType()
			]
		);
		$this->db->insert('doctors', [
			'doctorId' => parent::getUserId(),
			'surname' => parent::getSurname(),
			'otherNames' => parent::getOtherNames(),
			'phoneNumber' => parent::getPhoneNumber(),
			'email' => parent::getEmail(),
			'daysAvailable' => $this->daysAvailable,
			'status' => parent::getStatus()
		]);
		return $this;
	}

	/**
	 * Get All Doctors
	 *
	 * @return array
	 */
	public function getDoctors(): array
	{
		$doctors = $this->db->select('doctors', '*');
		return $doctors;
	}

	/**
	 * @param string $username
	 * @return int
	 */
	public function getId(string $username): int
	{
		$id = $this->db->get('doctors', 'id', [
			'doctorId' => $username
		]);
		return $id;
	}


}
