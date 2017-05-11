<?php

namespace HMS\Processor;

/**
 * Class Sessions
 * @package HMS\Processor
 */
Class Sessions
{
	/**
	 * Initialize Session
	 *
	 * @return void
	 */
	public static function init()
	{
		session_start(
			[
				'name' => 'pd',
				'cookie_httponly' => 1,
				"use_strict_mode" => 1,
			]
		);
		session_regenerate_id();
	}

	/**
	 * Destroy Session
	 *
	 * @return void
	 */
	public static function destroy()
	{
		session_unset();
		session_destroy();
	}


	/**
	 * Checks if $_SESSION variable exists
	 *
	 * @param string $name $_SESSION variable
	 *
	 * @return bool
	 */
	public static function exists(string $name): bool
	{
		if (isset($_SESSION[$name])) {
			return true;
		}
			return false;

	}

	/**
	 * Delete item from $_SESSIONS array
	 *
	 * @param $name
	 */
	public static function delete($name)
	{
		if (self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}

	/**
	 * Get item from sessions
	 *
	 * @param string $items $_SESSION variable
	 *
	 * @return mixed
	 */
	public static function get(string $items)
	{
		$items = explode('/', $items);
		if (count($items) == 1) {
			return self::exists(end($items)) ? Functions::get($_SESSION, end($items)) : false;
		} else {
			foreach ($items as $item) {
				$result = Functions::get($_SESSION, $item);
			}
			return $result;
		}
	}

	/**
	 * Flash message or create flash messsage
	 *
	 * @param $name
	 * @param string $string
	 *
	 * @return string
	 */
	public static function flash($name, $string = ''): string
	{
		if (self::exists($name)) {
			$session = Functions::get($_SESSION, $name);
			self::delete($name);
			return $session;
		} else {
			$_SESSION[$name] = $string;
		}
	}

}