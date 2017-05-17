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
			'specialistId' => parent::getUserId(),
			'surname' => parent::getSurname(),
			'otherNames' => parent::getOtherNames(),
			'phoneNumber' => parent::getPhoneNumber(),
			'email' => parent::getEmail(),
			'maxPatients' => $this->getMaxPatients(),
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
	 * Get Available Patients to Specialist
	 *
	 * @param string $username
	 * @return bool|mixed
	 */
	public function getMaxPatientsDb(string $username)
	{
		return $this->db->get('specialists', 'maxPatients', ['specialistId' => $username]);
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
	public function getIdDb($username): int
	{
		$id = $this->db->get('specialists', 'id', [
			'specialistId' => $username
		]);
		return $id;
	}

	/**
	 * Gets Total Available Specialist Appointment from Db
	 *
	 * @param int $id
	 * @return int
	 */
	public function getAptCounter(int $id): int
	{
		return $this->db->get('specialists', 'appointments', ['id' => $id]);
	}

	public function getCurrentPatientsDb($username): int
	{
		return $this->db->get('specialists', 'currentPatients', ['specialistId' => $username]);
	}

	/**
	 * @param int $amount
	 * @return int
	 */
	public function incCurrentPatients(int $amount): int
	{
		return $amount += 1;
	}

	public function saveOptions(string $username, string $status, $maxPatients)
	{
		return $this->db->update('specialists', ['status' => $status, 'maxPatients' => $maxPatients], ['specialistId' => $username]);
	}

}
