<?php

namespace HMS\Database;


use PDO;
use Medoo\Medoo;

class Database extends Config
{
	private $db;
	private static $instance;

	/**
	 * Database constructor.
	 */
	public function __construct()
	{
		try {
			$this->db = new Medoo(
				[
					'database_type' => 'mysql',
					'database_name' => parent::$db_params['DB_NAME'],
					'server' => 'localhost',
					'username' => parent::$db_params['DB_USERNAME'],
					'password' => parent::$db_params['DB_PASSWORD'],
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
//		return $this->db;
	}

	/**
	 * Creates instance of database connection
	 *
	 * @return \Medoo\Medoo
	 */
	public static function _db()
	{
		if (!isset(self::$instance)) {
			self::$instance = new self();

		}
		return self::$instance->db;
	}
}
