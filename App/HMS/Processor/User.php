<?php

namespace HMS\Processor;

use HMS\Database\Database;
use Carbon\Carbon;

/**
 * Class User
 * @package HMS\Processor
 */
class User extends Database
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

	/**
	 * Creates User Object
	 *
	 */
	public function __construct()
	{
		parent::__construct();
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
		$id = sprintf('%03d', $this->db->max("$table", 'id') + 1);
		$year = Carbon::today();
		$year = $year->format('y');
		$this->userId = "$prefix/" . $year . '-' . $id;
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
	 * Get User Username in Db
	 *
	 * @param string $id
	 * @param string $table remove 's' from table name
	 * @return string
	 */
	public function getUsernameDb(string $id, string $table): string
	{
		return $this->db->get("{$table}s", "{$table}id", ['id' => $id]);
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
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
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
	 * Gets User Type
	 *
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @param string $username
	 * @return string
	 */
	public function getUserTypeDb(string $username): string
	{
		return $this->db->get('users', 'type', ['username' => "$username"]);
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
	 * Gets User Password
	 *
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
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
	 * Gets User Surname
	 *
	 * @return string
	 */
	public function getSurname(): string
	{
		return $this->surname;
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
		return $this->db->get("{$table}s", 'surname', ["{$table}Id" => $username]);
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
	 * Gets User OtherNames
	 *
	 * @return string
	 */
	public function getOtherNames(): string
	{
		return $this->otherNames;
	}

	public function getOtherNamesDb(string $username, string $table): string
	{
		return $this->db->get("{$table}s", 'otherNames', ["{$table}Id" => $username]);
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
	 * Gets User PhoneNumber
	 *
	 * @return string
	 */
	public function getPhoneNumber(): string
	{
		return $this->phoneNumber;
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
	 * Gets User Email
	 *
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
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
	 * Get Status
	 *
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @param string $username
	 * @param string $table
	 * @return string
	 */
	public function getStatusDb(string $username, string $table): string
	{
		return $this->db->get("{$table}s", 'status', ["{$table}Id" => $username]);
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
		return $this->db->select('appointments', '*', ["{$table}Id" => $username, 'ORDER' => ['appointments.id' => 'DESC']]);
	}

	/**
	 * @param string $username
	 * @param string $type
	 * @return array
	 */
	public function getAllConfirmedAppt(string $username, string $type): array
	{
		$type = $type === 'patient' ? $type : 'doctor';
		return $this->db->select('diagnosis', '*', ["{$type}Id" => $username, 'ORDER' => ['id' => 'DESC']]);
	}

	/**
	 * Reset patient's appointment counter
	 *
	 * @param string $username
	 */
	public function resetApptCounter(string $username)
	{
		$lastAppointment = new Carbon($this->db->get('patients', 'lastAppointment', ['patientId' => $username]));

		$today = Carbon::now();
		if ($today->diffInDays($lastAppointment) > 0) {
			$this->db->update('patients', ['appointments' => '2'], ['patientId' => $username]);
		}
	}


}
