<?php

namespace HMS\Modules\Patient;

use HMS\Database\Database as DB;
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
	protected $dateOfBirth;

	/**
	 * @return mixed
	 */
	public function getDateOfBirth()
	{
		return $this->dateOfBirth;
	}

	/**
	 * @param mixed $dateOfBirth
	 */
	public function setDateOfBirth($dateOfBirth)
	{
		$this->dateOfBirth = $dateOfBirth;
	}

	/**
	 * Patient Constructor
	 *
	 */
	public function __construct()
	{
		parent::setType('patient');
	}

	/**
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $gender
	 * @param  $dob
	 * @param string $address
	 * @param string $phoneNumber
	 * @param string $email
	 * @return $this
	 */
	public function registerAsPatient(string $surname, string $otherNames, string $gender, string $address, string $phoneNumber, $dob, string $email)
	{

		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setGender($gender);
		parent::setAddress($address);
		parent::setPhoneNumber($phoneNumber);
		$this->setDateOfBirth($dob);
		parent::setEmail($email);

		DB::_db()->insert('pending_registration', [
			'surname' => parent::getSurname(),
			'otherNames' => parent::getOtherNames(),
			'gender' => parent::getGender(),
			'address' => parent::getAddress(),
			'phoneNumber' => parent::getPhoneNumber(),
			'date_of_birth' => $this->getDateOfBirth(),
			'email' => parent::getEmail(),
			'type' => parent::getType()
		]);
		return $this;
	}

	/**
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $gender
	 * @param $dob
	 * @param string $address
	 * @param string $phoneNumber
	 * @param string $email
	 * @return $this
	 */
	public function createPatient(string $surname, string $otherNames, string $gender, $dob, string $address, string $phoneNumber, string $email)
	{
		parent::setUserId('patients', 'PAT');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setGender($gender);
		parent::setAddress($address);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);
		$this->setDateOfBirth($dob);

		DB::_db()->insert('users', [
				'username' => parent::getUserId(),
				'password' => parent::getPassword(),
				'type' => $this->getType()
			]
		);
		DB::_db()->insert('patients', [
			'patientId' => parent::getUserId(),
			'surname' => parent::getSurname(),
			'otherNames' => parent::getOtherNames(),
			'gender' => parent::getGender(),
			'date_of_birth' => $this->getDateOfBirth(),
			'address' => parent::getAddress(),
			'phoneNumber' => parent::getPhoneNumber(),
			'email' => parent::getEmail()
		]);
		return $this;
	}

	public function updatePatient($patientId,string $surname, string $otherNames, string $gender, $dob, string $address, string $phoneNumber, string $email)
	{
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setGender($gender);
		parent::setAddress($address);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);
		$this->setDateOfBirth($dob);

		DB::_db()->update('users', [
				'username' => $patientId
			],[
				'username' => $patientId
			]
		);
		DB::_db()->update('patients', [
			'surname' => parent::getSurname(),
			'otherNames' => parent::getOtherNames(),
			'gender' => parent::getGender(),
			'date_of_birth' => $this->getDateOfBirth(),
			'address' => parent::getAddress(),
			'phoneNumber' => parent::getPhoneNumber(),
			'email' => parent::getEmail()
		],[
				'patientId' => $patientId
			]);
		return $this;
	}

	public function getAllPatients()
	{
		return DB::_db()->select('patients', '*');
	}

	/**
	 * Gets Patient PatientId
	 *
	 * @param $username
	 * @return int
	 */
	public function getIdDb($username): int
	{
		$id = DB::_db()->get('patients', 'id', [
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
		return DB::_db()->get('patients', 'Appointments', ['id' => $id]);
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

		DB::_db()->insert('appointments', [
			'patientId' => "{$patientUsername}",
			'doctorId' => "{$doctorUsername}"
		]);

		$appointmentTime = DB::_db()->get('appointments', 'appointment_date', ['id' => DB::_db()->id()]);
		/**
		 *Update Patient's available Appointments && Last Appointment Date
		 */
		DB::_db()->update('patients', ['appointments' => $this->rdAptCounter($this->getAptCounter($patientId)), 'lastAppointment' => $appointmentTime], ['id' => $patientId]);

		/**
		 *Update Doctor's or Specialist's Last Appointment Date
		 */
		DB::_db()->update("{$type}s", ['lastAppointment' => $appointmentTime], ['id' => $doctorId]);

		/**
		 * Update max Patients for specialist
		 */
		if ($type === 'specialist') {
			$specialist = new Specialist();
			DB::_db()->update('specialists', ['currentPatients' => $specialist->incCurrentPatients($specialist->getCurrentPatientsDb($doctorId))], ['id' => $doctorId]);
		}

		return true;
	}

	/**
	 * @param int $aptId
	 * @param string $id
	 * @param string $doctorId
	 */
	public function confirmAppointment(int $aptId, string $id, string $doctorId)
	{
		$patientId = $this->getUsernameDb($id, 'patient');
		DB::_db()->update('appointments', ['status' => 'Confirmed'], ['id' => $aptId, 'patientId' => $patientId, 'doctorId' => $doctorId]);
		DB::_db()->insert('consultations', ['appointment_id' => $aptId, 'patientId' => $patientId, 'doctorId' => $doctorId]);
	}


}
