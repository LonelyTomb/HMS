<?php

namespace HMS\Modules\Admin;

use HMS\Database\Database as DB;
use HMS\Processor\{
	User, Validator
};

class Admin extends User
{
	/**
	 * Admin constructor.
	 */
	public function __construct()
	{
		parent::setType('admin');

	}

	/**
	 * @param string $username
	 * @param string $password
	 * @return $this
	 */
	public function createAdmin(string $username, string $password)
	{
		parent::setUsername($username);
		parent::setPassword($password);
		DB::_db()->insert('users', [
				'username' => parent::getUsername(),
				'password' => parent::getPassword(),
				'type' => parent::getType()
			]
		);
		return $this;
	}
}
