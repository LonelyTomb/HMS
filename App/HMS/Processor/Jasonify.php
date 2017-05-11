<?php

namespace HMS\Processor;
/**
 * Class Jasonify
 * @package HMS\Processor
 */
Class Jasonify
{
	/**
	 * @param $arr
	 * @return string
	 */
	public static function toJson($arr)
	{
		return utf8_encode(json_encode($arr, JSON_PRETTY_PRINT));
	}

	/**
	 * @param $json
	 * @return mixed
	 */
	public static function toArray($json)
	{
		return json_decode($json, true);
	}

}