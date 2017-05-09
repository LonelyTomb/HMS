<?php

namespace HMS\Modules\Patient;

use HMS\Modules\Doctor\Doctor;
use HMS\Modules\Doctor\Specialist;
use HMS\Processor\{
	Functions, Input, User
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
		parent::setType('Patient');
		parent::setUserId('patients', 'PAT');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		$this->setAddress($address);
		parent::setPhoneNumber($phoneNumber);
		parent::setEmail($email);

		$this->db->insert("users", [
				"username" => parent::getUserId(),
				"password" => parent::getPassword(),
				"type" => $this->getType()
			]
		);
		$this->db->insert("patients", [
			"PatientId" => parent::getUserId(),
			"Surname" => parent::getSurname(),
			"OtherNames" => parent::getOtherNames(),
			"Address" => $this->getAddress(),
			"PhoneNumber" => parent::getPhoneNumber(),
			"Email" => parent::getEmail()
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
	public function getId($username): int
	{
		$id = $this->db->get('patients', 'id', [
			'PatientId' => $username
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
		return $this->get('patient', "Appointments", ["id" => $id]);
	}


	public function makeAppointment()
	{
		if (Input::getExists('make')) {

			$patientId = Functions::escape(Input::catch ('id'));
			$type = Functions::escape(Input::catch ('type'));
			$doctorId = Functions::escape(Input::catch ('docId'));

			if ($this->getAptCounter($patientId) == 0) {
				return ["error" => "Maximum number of appointments made"];
			}

			if ($type == 'doctors') {
				$doctors = new Doctor();
				$doctorUserId = $doctors->getId($doctorId);
			} else if ($type == 'Specialists') {
				$specialists = new Specialist();
				$doctorUserId = $specialists->getId($doctorId);
			} else {
				return false;
			}

			$this->db->insert('appointments', [
				"PatientId" => "$patientId",
				"DoctorId" => "$doctorUserId"
			]);

			$appointmentTime = $this->get("appointments", "AppointmentDate", ["id" => $this->db->id()]);
			#Update Patient's available Appointments && Last Appointment Date
			$this->db->update("patients", ["Appointment"=>$this->rdAptCounter($this->getAptCounter($patientId)),"LastAppointment"=>$appointmentTime],["id"=>$patientId]);


			#Update Doctor's or Specialist's Last Appointment Date
			$this->db->update($type, ["LastAppointment"=>$appointmentTime],["id"=>$doctorUserId]);

			if($type == "specialists"){
				$this->db->update("specialists", ["MaxPatients"=>$specialists->rdMaxPatients($specialists->getMaxPatientsDb($doctorId))],["id"=>$doctorUserId]);
			}


		}
	}
}
