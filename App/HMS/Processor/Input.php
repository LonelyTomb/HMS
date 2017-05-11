<?php

namespace HMS\Processor;
/**
 * Class Input
 * @package HMS\Processor
 */
class Input
{
	/**
	 * Checks If data is sent
	 *
	 * @param string $type
	 * @return boolean
	 */
	public static function exists($type = 'post'): bool
	{
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;
			case 'get':
				return (!empty($_GET)) ? true : false;
				break;
			default :
				return false;
				break;
		}
	}

	/**
	 * Gets data from POST or GET
	 *
	 * @param string $item
	 * @return mixed
	 */
	public static function catch (string $item)
	{
		return $_POST[$item] ?? $_GET[$item] ?? '';
	}

	/**
	 * Checks if a variable exists in $_GET array
	 *
	 * @param string $item
	 * @return bool
	 */
	public static function getExists(string $item): bool
	{
		return isset($_GET[$item]) ? TRUE : FALSE;
	}
}