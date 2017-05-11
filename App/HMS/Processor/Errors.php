<?php

namespace HMS\Processor;


class Errors
{
	public static $error = [];

	/**
	 * @param $name
	 * @param $desc
	 */
	public static function addError($name, $desc)
	{
		self::$error[$name] = $desc;
	}

	/**
	 * @return array
	 */
	public static function getError(): array
	{
		return self::$error;
	}
	/**
	 * Display all errors
	 *
	 * @param array $errors
	 * @return void
	 */
	public static function allErrors(array $errors)
	{
		foreach ($errors as $key => $error) {
			$error = is_array($error) ? end($error) : $error;
			Functions::toast($error);
		}
	}

	/**
	 * Displays particular error
	 *
	 * @param array $errors
	 * @param string $errorName
	 * @return void
	 */
	public static function display(array $errors, string $errorName)
	{
		foreach ($errors as $key => $error) {
			if ($key === $errorName) {
				Functions::toast(end($error));
			}
		}
	}

	/**
	 * Displays First error
	 *
	 * @param array $errors
	 * @return void
	 */
	public static function firstError(array $errors)
	{
		Functions::toast(end($errors));
	}

	/**
	 * Displays Last Error
	 *
	 * @param array $errors
	 * @return void
	 */
	public static function lastError(array $errors)
	{
		Functions::toast(end($errors));
	}

}