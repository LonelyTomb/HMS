<?php

namespace HMS\Processor;

use HMS\Database\Database as DB;
use Carbon\Carbon;

/**
 * Class User
 * @package HMS\Processor
 */
class User
{
	protected $username;
	protected $userId;
	protected $type;
	protected $password;
	protected $surname;
	protected $otherNames;
	protected $phoneNumber;
	protected $email;
	protected $status;
	protected $address;
	protected $gender;

	public function getUserFromDb(string $username)
	{
		return DB::_db()->get('users', '*', ['username' => $username]);
	}

	public function deleteUser(string $username, string $type)
	{
		if ($type == 'admin') {
			DB::_db()->delete('users', ["id" => $username]);
		} else {
			DB::_db()->delete("{$type}s", ["{$type}Id" => $username]);
		}
	}

	public function getPendingUsers(string $type)
	{
		return DB::_db()->select('pending_registration', '*', ['type' => $type]);
	}

	public function deletePendingUser(string $email)
	{
		DB::_db()->delete('pending_registration', ["email" => $email]);
	}

	/**
	 * Get User Id
	 *
	 * @return string
	 */
	public function getUserId(): string
	{
		return $this->userId;
	}

	/**
	 * generate User id
	 *
	 * @param string $table
	 * @param string $prefix
	 * @return void
	 */
	public function setUserId(string $table, string $prefix)
	{
		$id = DB::_db()->query("SELECT AUTO_INCREMENT
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'HMS'
AND TABLE_NAME = '{$table}'")->fetch();
		$id = sprintf('%03d', $id->AUTO_INCREMENT);
		$year = Carbon::today();
		$year = $year->format('y');
		$this->userId = "$prefix/" . $year . '-' . $id;
	}

	/**
	 * Get User Username in Db
	 *
	 * @param string $id
	 * @param string $table remove 's' from table name
	 * @return string
	 */
	public function getUsernameDb(string $id, string $table): string
	{
		return DB::_db()->get("{$table}s", "{$table}id", ['id' => $id]);
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * Sets username
	 *
	 * @param string $username
	 * @return void
	 */
	public function setUsername(string $username)
	{
		$this->username = $username;
	}

	/**
	 * Gets User Type
	 *
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * Sets User Type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType(string $type)
	{
		$this->type = $type;
	}

	/**
	 * @param string $username
	 * @return string
	 */
	public function getUserTypeDb(string $username): string
	{
		return DB::_db()->get('users', 'type', ['username' => "$username"]);
	}

	/**
	 * Gets User Password
	 *
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * Sets User Password
	 *
	 * @param string $password
	 * @return void
	 */
	public function setPassword(string $password)
	{
		$this->password = password_hash($password, PASSWORD_DEFAULT);
	}

	/**
	 * Reset User Password
	 *
	 * @param string $username
	 * @param string $email
	 * @param string $password
	 * @return bool
	 */
	public function resetPassword(string $username, string $email, string $password): bool
	{
		$status = false;
		$userType = DB::_db()->get('users', 'type', [
			'username' => $username]);
		if ($userType && $userType != 'admin') {
			$emailDB = DB::_db()->get("{$userType}s", 'email', [
				"{$userType}Id" => $username
			]);
			if ($emailDB && $email === $emailDB) {
				$new_password = password_hash($password, PASSWORD_DEFAULT);
				DB::_db()->update('users', [
					'password' => $new_password
				], [
					'username' => $username
				]);
				$status = true;
			}
			return $status;
		}
		return $status;
	}

	/**
	 * Gets User Surname
	 *
	 * @return string
	 */
	public function getSurname(): string
	{
		return $this->surname;
	}

	/**
	 * Sets User Surname
	 *
	 * @param string $surname
	 * @return void
	 */
	public function setSurname(string $surname)
	{
		$this->surname = $surname;
	}

	/**
	 * Get Surname from Db
	 *
	 * @param string $username
	 * @param string $table remove 's' from table name
	 * @return bool|mixed
	 */
	public function getSurnameDb(string $username, string $table)
	{
		return DB::_db()->get("{$table}s", 'surname', ["{$table}Id" => $username]);
	}

	/**
	 * Gets User OtherNames
	 *
	 * @return string
	 */
	public function getOtherNames(): string
	{
		return $this->otherNames;
	}

	/**
	 * Sets User OtherNames
	 *
	 * @param string $otherNames
	 * @return void
	 */
	public function setOtherNames(string $otherNames)
	{
		$this->otherNames = $otherNames;
	}

	/**
	 * @param string $username
	 * @param string $table
	 * @return string
	 */
	public function getOtherNamesDb(string $username, string $table): string
	{
		return DB::_db()->get("{$table}s", 'otherNames', ["{$table}Id" => $username]);
	}

	/**
	 * @return string
	 */
	public function getGender(): string
	{
		return $this->gender;
	}

	/**
	 * @param string $gender
	 */

	public function setGender(string $gender)
	{
		$this->gender = $gender;
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
	 * Gets User PhoneNumber
	 *
	 * @return string
	 */
	public function getPhoneNumber(): string
	{
		return $this->phoneNumber;
	}

	/**
	 * Sets User PhoneNumber
	 *
	 * @param string $phoneNumber
	 * @return void
	 */
	public function setPhoneNumber(string $phoneNumber)
	{
		$this->phoneNumber = $phoneNumber;
	}

	/**
	 * Gets User Email
	 *
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * Sets User Email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail(string $email)
	{
		$this->email = $email;
	}

	/**
	 * Get Status
	 *
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * Sets Doctor's availability
	 *
	 * @param string $daysAvailable
	 * @return void
	 */
	public function setStatus($daysAvailable)
	{
		$this->status = 'Available';

		if (empty($daysAvailable)) {
			$this->status = 'Unavailable';
		}

	}

	/**
	 * @param string $username
	 * @param string $table
	 * @return string
	 */
	public function getStatusDb(string $username, string $table): string
	{
		return DB::_db()->get("{$table}s", 'status', ["{$table}Id" => $username]);
	}


	/**
	 * Reduce Patient/Specialist Appointment Counter
	 *
	 * @param string $counter
	 * @return int
	 */
	public function rdAptCounter(string $counter): int
	{
		return $counter -= 1;
	}


	/**
	 * Get All Appointments
	 *
	 * @param string $username
	 * @param string $table
	 *
	 * @return array
	 */
	public function getAllAppointments(string $username, string $table): array
	{
		$table = $table === 'patient' ? $table : 'doctor';
		return DB::_db()->select('appointments', '*', ["{$table}Id" => $username, 'ORDER' => ['appointments.id' => 'DESC']]);
	}

	/**
	 * @param string $username
	 * @param string $type
	 * @return array
	 */
	public function getAllConfirmedAppt(string $username, string $type): array
	{
		$type = $type === 'patient' ? $type : 'doctor';
		return DB::_db()->select('consultations', '*', ["{$type}Id" => $username, 'ORDER' => ['id' => 'DESC']]);
	}

	/**
	 * Reset patient's appointment counter
	 *
	 * @param string $username
	 */
	public function resetApptCounter(string $username)
	{
		$lastAppointment = new Carbon(DB::_db()->get('patients', 'lastAppointment', ['patientId' => $username]));

		$today = Carbon::now();
		if ($today->diffInDays($lastAppointment) > 0) {
			DB::_db()->update('patients', ['appointments' => '2'], ['patientId' => $username]);
		}
	}

	public function getDetail(String $id, String $table)
	{
		return DB::_db()->get("{$table}s", '*', [
			"{$table}Id" => $id
		]);
	}


}
