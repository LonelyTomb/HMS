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
		$id = sprintf('%03d', $this->db->max("$table", "id") + 1);
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
	public function setStatus(string $daysAvailable)
	{
		if ($daysAvailable === '') {
			$this->status = 'Unavailable';
		} else {
			$this->status = 'Available';
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
	 * Get User Username in Db
	 *
	 * @param string $identifier
	 * @param string $table table name without s
	 * @return string
	 */
	public function getUsernameDb(string $identifier, string $table): string
	{
		return $this->db->get("{$table}s", "{$table}id", ['id' => $identifier]);
	}
	/**
	 * Reduce Patient/Specialist Appointment Counter
	 *
	 * @param $counter
	 * @return int
	 */
	public function rdAptCounter($counter):int
	{
		return $counter-=1;
	}

	/**
	 * @param string $username
	 * @return string
	 */
	public function getUserTypeDb(string $username): string
	{
		return $this->db->get('users', 'type', ['username' => "$username"]);
	}

	public function getSurnameDb(string $username, string $table)
	{
		return $this->db->get("{$table}s", 'surname', ["{$table}Id" => $username]);
	}

	public function resetApptCounter($id)
	{
		$lastAppointment = $this->db->get('patients', 'lastAppointment', ['id' => $id]);
		$lastAppointment = new Carbon($lastAppointment);
		$today = Carbon::now();
		if ($today->diffInDays($lastAppointment) > 0) {
			$this->db->update('patients', ['appointments' => '2'], ['id' => $id]);
		}
	}


}
