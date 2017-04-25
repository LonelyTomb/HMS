<?php

namespace HMS\Processor;

use HMS\Database\Database;

class User extends Database
{
	protected $username;
	protected $type;
	protected $password;
	protected $surname;
	protected $otherNames;
	protected $phoneNumber;
	protected $email;

	/**
	* Creates User Object
	     *
	     * @param string $username
	     * @param string $type
	     * @param string $password
	     */
	    public function __construct(string $username,string $password, string $type){
		parent::__construct();
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setType($type);
	}

	/**
	* Sets username
	     *
	     * @param string $username
	     * @return void
	     */
	    public function setUsername(string $username){
		$this->username = $username;
	}

	/**
	* Get username
	     *
	     * @return string
	     */
	    public function getUsername():string{
		return $this->username;
	}

	/**
	* Sets User Type
	     *
	     * @param string $type
	     * @return void
	     */
	    public function setType(string $type){
		$this->type = $type;
	}

	/**
	* Gets User Type
	     *
	     * @return string
	     */
	    public function getType():string{
		return $this->type;
	}

	/**
	* Sets User Password
	     *
	     * @param string $password
	     * @return void
	     */
	    public function setPassword(string $password){
		$this->password = password_hash($password,PASSWORD_DEFAULT);
	}

	/**
	* Gets User Password
	     *
	     * @return string
	     */
	    public function getPassword():string{
		return $this->password;
	}

	/**
	* Sets User Surname
	     *
	     * @param string $surname
	     * @return void
	     */
	    public function setSurname(string $surname){
		$this->surname = $surname;
	}

	/**
	* Gets User Surname
	     *
	     * @return string
	     */
	    public function getSurname():string{
		return $this->surname;
	}
/**
	* Sets User OtherNames
	     *
	     * @param string $otherNames
	     * @return void
	     */
	    public function setOtherNames(string $otherNames){
		$this->otherNames = $otherNames;
	}

	/**
	* Gets User OtherNames
	     *
	     * @return string
	     */
	    public function getOtherNames():string{
		return $this->type;
	}

/**
	* Sets User PhoneNumber
	     *
	     * @param string $phoneNumber
	     * @return void
	     */
	    public function setPhoneNumber(string $phoneNumber){
		$this->phoneNumber = $phoneNumber;
	}

	/**
	* Gets User PhoneNumber
	     *
	     * @return string
	     */
	    public function getPhoneNumber():string{
		return $this->phoneNumber;
	}
/**
	* Sets User Email
	     *
	     * @param string $type
	     * @return void
	     */
	    public function setEmail(string $email){
		$this->email = $email;
	}

	/**
	* Gets User Email
	     *
	     * @return string
	     */
	    public function getEmail():string{
		return $this->email;
	}

}
