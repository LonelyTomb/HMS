<?php

namespace HMS\Processor;


class Errors
{
	/**
	 * Display all errors
	 *
	 * @param array $errors
	 * @return void
	 */
	public static function allErrors(array $errors)
	{
		foreach ($errors as $key => $error) {
			Functions::toast(end($error));
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
			if ($key == $errorName) {
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