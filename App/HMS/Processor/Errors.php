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
	 * @param string $alertType
	 * @return void
	 */
	public static function allErrors(array $errors, string $alertType = 'toast')
	{
		foreach ($errors as $key => $error) {
			$error = is_array($error) ? end($error) : $error;
			if ($alertType === 'toast') {
				Functions::toast($error);
			} elseif ($alertType === 'jGrowl') {
				Functions::jGrowl(['message' => $error, 'theme' => 'alert-styled-left bg-warning alert-arrow-left', 'life' => 10000]);
			}
		}
	}

	/**
	 * Displays particular error
	 *
	 * @param array $errors
	 * @param string $errorName
	 * @param string $alertType
	 * @return void
	 */
	public static function display(array $errors, string $errorName, string $alertType = 'toast')
	{
		foreach ($errors as $key => $error) {
			if ($key === $errorName) {
				if ($alertType === 'toast') {
					Functions::toast(end($error));
				} elseif ($alertType === 'jGrowl') {
					Functions::jGrowl(['message' => end($error), 'theme' => 'alert-styled-left bg-warning alert-arrow-left', 'life' => 10000]);
				}
			}
		}
	}

	/**
	 * Displays First error
	 *
	 * @param array $errors
	 * @param string $alertType
	 * @return void
	 */
	public static function firstError(array $errors, string $alertType = 'toast')
	{
		if ($alertType === 'toast') {
			Functions::toast($errors[0]);
		} elseif ($alertType === 'jGrowl') {
			Functions::jGrowl(['message' => $errors[0], 'theme' => 'alert-styled-left bg-warning alert-arrow-left', 'life' => 10000]);
		}
	}

	/**
	 * Displays Last Error
	 *
	 * @param array $errors
	 * @param string $alertType
	 * @return void
	 */
	public static function lastError(array $errors, string $alertType = 'toast')
	{
		if ($alertType === 'toast') {
			Functions::toast(end($errors));
		} elseif ($alertType === 'jGrowl') {
			Functions::jGrowl(['message' => end($errors), 'theme' => 'alert-styled-left bg-warning alert-arrow-left', 'life' => 10000]);
		}
	}

}