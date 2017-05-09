<?php

namespace HMS\Database;


use PDO;

class Database extends Config
{
	protected $db;

	/**
	 * Database constructor.
	 */
	public function __construct()
	{
		try {
			$this->db = new Medoo(
				[
					'database_type' => 'mysql',
					'database_name' => $this->db_params['DB_NAME'],
					'server' => 'localhost',
					'username' => $this->db_params['DB_USERNAME'],
					'password' => $this->db_params['DB_PASSWORD'],
					'charset' => 'utf8',
					'option' => [
						PDO::ATTR_CASE => PDO::CASE_NATURAL,
						PDO::ATTR_PERSISTENT => true,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
						PDO::ATTR_EMULATE_PREPARES => false,
					]
				]
			);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		return $this;
	}
}
