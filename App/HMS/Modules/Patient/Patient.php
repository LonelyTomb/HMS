<?php

namespace HMS\Modules\Patient;

use HMS\Modules\Doctor\Specialist;
use HMS\Processor\{
	Errors, Functions, Input, User
};

/**
 * Class Patient
 * @package HMS\Modules\Patient
 */
class Patient extends User
{
	protected $patientId;
	protected $address;

	/**
	 * Patient Constructor
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		parent::setType('patient');
	}

	/**
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $address
	 * @param string $phoneNumber
	 * @param string $email
	 * @return $this
	 */
	public function createPatient(string $surname, string $otherNames, string $address, string $phoneNumber, string $email)
	{
		parent::setUserId('patients', 'PAT');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		$this->setAddress($address);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);

		$this->db->insert('users', [
				'username' => parent::getUserId(),
				'password' => parent::getPassword(),
				'type' => $this->getType()
			]
		);
		$this->db->insert('patients', [
			'PatientId' => parent::getUserId(),
			'Surname' => parent::getSurname(),
			'OtherNames' => parent::getOtherNames(),
			'Address' => $this->getAddress(),
			'PhoneNumber' => parent::getPhoneNumber(),
			'Email' => parent::getEmail()
		]);
		return $this;
	}

	/**
	 * Sets User Address
	 *
	 * @param string $address
	 * @return void
	 */
	public function setAddress(string $address)
	{
		$this->address = $address;
	}

	/**
	 * Gets User Address
	 *
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * Gets Patient PatientId
	 *
	 * @param $username
	 * @return int
	 */
	public function getIdDb($username): int
	{
		$id = $this->db->get('patients', 'id', [
			'patientId' => $username
		]);
		return $id;
	}

	/**
	 * Gets Total Available Patient Appointment
	 *
	 * @param $id
	 * @return int
	 */
	public function getAptCounter($id): int
	{
		return $this->db->get('patients', 'Appointments', ['id' => $id]);
	}

	/**
	 * Make Appointment Function
	 *
	 * @return boolean
	 */
	public function makeAppointment(): bool
	{

		$patientId = Functions::escape(Input::catch ('id'));
		$type = Functions::escape(Input::catch ('type'));
		$doctorId = Functions::escape(Input::catch ('docId'));

		if ($this->getAptCounter($patientId) === 0) {
			Errors::addError('Max Appointments', 'Maximum Appointments reached');
			return false;
		}

		$patientUsername = $this->getUsernameDb($patientId, 'patient');
		$doctorUsername = $this->getUsernameDb($doctorId, $type);

		$this->db->insert('appointments', [
			'patientId' => "{$patientUsername}",
			'doctorId' => "{$doctorUsername}"
		]);

		$appointmentTime = $this->db->get('appointments', 'appointment_date', ['id' => $this->db->id()]);
		/**
		 *Update Patient's available Appointments && Last Appointment Date
		 */
		$this->db->update('patients', ['appointments' => $this->rdAptCounter($this->getAptCounter($patientId)), 'lastAppointment' => $appointmentTime], ['id' => $patientId]);

		/**
		 *Update Doctor's or Specialist's Last Appointment Date
		 */
		$this->db->update("{$type}s", ['lastAppointment' => $appointmentTime], ['id' => $doctorId]);

		/**
		 * Update max Patients for specialist
		 */
		if ($type === 'specialist') {
			$specialist = new Specialist();
			$this->db->update('specialists', ['currentPatients' => $specialist->incCurrentPatients($specialist->getCurrentPatientsDb($doctorId))], ['id' => $doctorId]);
		}

		return true;
	}

	/**
	 * @param string $id
	 * @param string $doctorId
	 */
	public function confirmAppointment(string $id, string $doctorId)
	{
		$patientId = $this->getUsernameDb($id, 'patient');
		$this->db->update('appointments', ['status' => 'Confirmed'], ['patientId' => $patientId, 'doctorId' => $doctorId]);
		$this->db->insert('diagnosis', ['patientId' => $patientId, 'doctorId' => $doctorId]);
	}


}
