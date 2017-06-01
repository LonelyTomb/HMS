<?php

namespace HMS\Modules\Doctor;

use HMS\Database\Database as DB;
use HMS\Processor\{
	Functions, User
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
		parent::setType('doctor');

	}

	/**
	 *
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $gender
	 * @param string $address
	 * @param string $phoneNumber
	 * @param string $email
	 * @param $daysAvailable
	 * @return $this
	 */
	public function registerAsDoctor(string $surname, string $otherNames, string $gender, string $address, string $phoneNumber, string $email, $daysAvailable)
	{

		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setPhoneNumber($phoneNumber);
		parent::setGender($gender);
		parent::setAddress($address);
		parent::setEmail($email);
		$this->daysAvailable = $daysAvailable;

		DB::_db()->insert('pending_registration', [
			'surname' => parent::getSurname(),
			'otherNames' => parent::getOtherNames(),
			'gender' => parent::getGender(),
			'address' => parent::getAddress(),
			'phoneNumber' => parent::getPhoneNumber(),
			'email' => parent::getEmail(),
			'daysAvailable' => $this->daysAvailable,
			'type' => parent::getType()
		]);
		return $this;
	}

	/**
	 * Doctor Creation function
	 *
	 * @param string $surname
	 * @param string $otherNames
	 * @param string $gender
	 * @param string $address
	 * @param string $phoneNumber
	 * @param string $email
	 * @param $daysAvailable
	 * @return void
	 */
	public function createDoctor(string $surname, string $otherNames, string $gender, string $address, string $phoneNumber, string $email, $daysAvailable)
	{
		parent::setUserId('doctors', 'DOC');
		parent::setPassword($surname);
		parent::setSurname($surname);
		parent::setOtherNames($otherNames);
		parent::setPhoneNumber($phoneNumber);
		parent::setGender($gender);
		parent::setAddress($address);
		parent::setEmail($email);
		$this->daysAvailable = $daysAvailable;
		parent::setStatus($this->daysAvailable);
		DB::_db()->insert('users', [
				'username' => parent::getUserId(),
				'password' => parent::getPassword(),
				'type' => $this->getType()
			]
		);

		DB::_db()->insert('doctors', [
			'doctorId' => parent::getUserId(),
			'surname' => parent::getSurname(),
			'otherNames' => parent::getOtherNames(),
			'gender' => parent::getGender(),
			'address' => parent::getAddress(),
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
		return DB::_db()->select('doctors', '*');
	}

	/**
	 * @param string $username
	 * @return int
	 */
	public function getIdDb(string $username): int
	{
		return DB::_db()->get('doctors', 'id', [
			'doctorId' => $username
		]);
	}

	/**
	 * @param string $username
	 * @return bool|mixed
	 *
	 */
	public function getDaysAvailableDb(string $username)
	{
		return DB::_db()->get('doctors', 'daysAvailable', ['doctorId' => $username]);
	}

	public function saveOptions(string $username, string $status, $dayAvailable)
	{
		return DB::_db()->update('doctors', ['status' => $status, 'daysAvailable' => $dayAvailable], ['doctorId' => $username]);
	}


}
