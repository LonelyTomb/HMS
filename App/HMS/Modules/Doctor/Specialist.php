<?php

namespace HMS\Modules\Doctor;

use HMS\Processor\{
	User
};

/**
 * Class Specialist
 * @package HMS\Modules\Doctor
 */
class Specialist extends User
{
	protected $specialistId;
	protected $maxPatients;

	/**
	 * Doctor Constructor
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		parent::setType('specialist');
	}

	/**
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $phoneNumber
	 * @param string $email
	 * @param string $maxPatients
	 * @return $this
	 */
	public function createSpecialist(string $surname, string $otherNames, string $phoneNumber, string $email, string $maxPatients)
	{

		parent::setUserId('specialists', 'SPE');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);
		$this->setMaxPatients($maxPatients);


		$this->db->insert('users', [
				'username' => parent::getUserId(),
				'password' => parent::getPassword(),
				'type' => $this->getType()
			]
		);
		$this->db->insert('specialists', [
			'SpecialistId' => parent::getUserId(),
			'Surname' => parent::getSurname(),
			'OtherNames' => parent::getOtherNames(),
			'PhoneNumber' => parent::getPhoneNumber(),
			'Email' => parent::getEmail(),
			'MaxPatients' => $this->getMaxPatients(),
		]);
		return $this;
	}

	/**
	 * @param string $maxPatients
	 */
	public function setMaxPatients(string $maxPatients)
	{
		$this->maxPatients = $maxPatients;
	}

	/**
	 * @return string
	 */
	public function getMaxPatients(): string
	{
		return $this->maxPatients;
	}

	/**
	 * @return array
	 */
	public function getSpecialists(): array
	{
		$doctors = $this->db->select('specialists', '*');
		return $doctors;
	}

	/**
	 * @param $username
	 * @return int
	 */
	public function getId($username): int
	{
		$id = $this->db->get('specialists', 'id', [
			'SpecialistId' => $username
		]);
		return $id;
	}

	/**
	 * Gets Total Available Specialist Appointment from Db
	 *
	 * @param $id
	 * @return int
	 */
	public function getAptCounter($id): int
	{
		return $this->get('specialists', 'Appointments', ['id' => $id]);
	}

	/**
	 * Get Available Patients to Specialist
	 *
	 * @param $id
	 * @return int
	 */
	public function getMaxPatientsDb($id): int
	{
		return $this->db->get('specialists', 'maxPatients', ['id' => $id]);
	}

	public function getCurrentPatientsDb($id): int
	{
		return $this->db->get('specialists', 'currentPatients', ['id' => $id]);
	}

	/**
	 * @param int $amount
	 * @return int
	 */
	public function incCurrentPatients(int $amount): int
	{
		return $amount += 1;
	}

}
