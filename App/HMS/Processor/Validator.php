<?php

namespace HMS\Processor;

use HMS\Database\Database;

/**
 * Class Validator
 * @package HMS\Processor
 */
class Validator extends Database
{
	private $valid = TRUE, $status = TRUE,
		$errors = array();

	/**
	 * Validator constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Validate Given Post or Get Array
	 *
	 * @param array $source
	 * @param array $rules
	 *
	 * @return bool
	 */
	public function validate(array $source, array $rules = array()): bool
	{

		foreach ($rules as $fieldname => $rule) {
			$callbacks = explode('|', $rule);

			foreach ($callbacks as $callback) {
				$value = Functions::escape($source[$fieldname]);
				$param = '';
				if (strpos($callback, ':')) {
					$temp = explode(':', $callback);
					$callback = current($temp);
					$param = next($temp);
				}
				if ($this->$callback($value, $fieldname, $param) === FALSE) $this->setStatus(FALSE);
			}
		}
		return $this->getStatus();
	}

	/**
	 * Set valid variable to true/false
	 *
	 * @param bool $status
	 */
	private function setStatus(bool $status)
	{
		$this->status = $status;
	}

	/**
	 * Get valid variable
	 *
	 * @return boolean
	 */
	public function getStatus():bool
	{
		return $this->status;
	}

	/**
	 * Add Form variable error to error array;
	 *
	 * @param string $item
	 * @param string $error
	 * @return void
	 */
	private function setErrors(string $item, string $error)
	{
		$this->errors[] = array($item => $error);
	}

	/**
	 * Get errors array
	 *
	 * @return array
	 */
	public function getErrors():array
	{
		return $this->errors;
	}

	/**
	 * Validate Username
	 *
	 * @param string $value
	 * @param string $fieldname
	 * @param string $param
	 * @return bool
	 */
	private function required(string $value, string $fieldname, string $param): bool
	{
		$this->valid = !empty($value);
		if ($this->valid === FALSE) $this->setErrors($fieldname, "The {$fieldname} is required");
		return $this->valid;
	}

	/**
	 * Validate Email
	 *
	 * @param string $value
	 * @param string $fieldname
	 * @param string $param
	 * @return bool
	 */
	private function email(string $value, string $fieldname, string $param): bool
	{
		$this->valid = filter_var($value, FILTER_VALIDATE_EMAIL);
		if ($this->valid === FALSE) {
			$this->setErrors($fieldname, "The {$fieldname} has to be valid");
		}
		return $this->valid;
	}

	/**
	 * Check if input is greater than minimum
	 *
	 * @param string $value
	 * @param string $fieldname
	 * @param string $param
	 * @return bool
	 */
	private function min(string $value, string $fieldname, string $param): bool
	{
		$this->valid = (strlen($value) >= $param);
		if ($this->valid === FALSE) $this->setErrors($fieldname, "The {$fieldname} has to a minimum of {$param}");
		return $this->valid;
	}

	/**
	 * Check if input is less than maximum
	 *
	 * @param string $value
	 * @param string $fieldname
	 * @param string $param
	 * @return bool
	 */
	private function max(string $value, string $fieldname, string $param): bool
	{
		$this->valid = (strlen($value) > $param);
		if ($this->valid === FALSE) {
			$this->setErrors($fieldname, "The {$fieldname} has to a maximum of {$param}");
		}
		return $this->valid;
	}

	/**
	 * Check if input matches
	 *
	 * @param string $value
	 * @param string $fieldname
	 * @param string $param
	 * @return bool
	 */
	private function match(string $value, string $fieldname, string $param): bool
	{
		$this->valid = ($value === Input::catch ($param));
		if ($this->valid === FALSE) $this->setErrors($fieldname, "The {$fieldname} does not match {$param}");
		return $this->valid;
	}

	/**
	 * Check if input unique
	 *
	 * @param string $value
	 * @param string $fieldname
	 * @param string $param
	 * @return bool
	 */
	private function unique(string $value, string $fieldname, string $param): bool
	{
		$dbParams = explode('.', $param);
		$table = $dbParams[0];
		$column = $dbParams[1];
		$this->valid = !$this->db->get("$table", '*', ["$column" => "$value"]) ? TRUE : FALSE;

		if ($this->valid === FALSE) {
			$this->setErrors($fieldname, "The {$fieldname} already exists");
		}
		return $this->valid;
	}

}
