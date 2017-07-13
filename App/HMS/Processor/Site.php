<?php

namespace HMS\Processor;

/**
 * Class Site
 * @package HMS\Processor
 */
class Site
{
	public static $title;
	public static $absPath;
	public static $root;

	/**
	 * Set absolute http address
	 *
	 * @return void
	 */
	public static function setRoot()
	{
		self::$root = 'http://' . $_SERVER['HTTP_HOST'] . CONFIG['customPath'];
	}

	/**
	 * Gets absolute http address
	 *
	 * @return string
	 */
	public static function getRoot(): string
	{
		self::setRoot();
		return self::$root;
	}

	/**
	 * Set Absolute Server path
	 *
	 * @return void
	 */
	public static function setAbsPath()
	{
		self::$absPath = $_SERVER['DOCUMENT_ROOT'] . CONFIG['customPath'];
	}

	/**
	 * Gets Absolute Server path
	 *
	 * @return string
	 */
	public static function getAbsPath(): string
	{
		self::setAbsPath();
		return self::$absPath;
	}

	/**
	 * require using absolute path
	 *
	 * @param string $path
	 * @return void
	 */
	public static function reqAbs(string $path)
	{
		require self::getAbsPath() . '/' . $path;
	}

	/**
	 * Sets Page Title
	 *
	 * @param string $title
	 * @return void
	 */
	public static function setPageTitle(string $title)
	{
		self::$title = $title;
	}

	/**
	 * Prints Page Title
	 *
	 * @return string
	 */
	public static function getPageTitle()
	{
		echo self::$title;
	}

	/**
	 * @return string
	 */
	public static function getReferUrl(): string
	{
		return $_SERVER['HTTP_REFERER'] ?? '';
	}
}