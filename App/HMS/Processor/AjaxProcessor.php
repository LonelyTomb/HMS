<?php

namespace HMS\Processor;


/**
 * Created by PhpStorm.
 * User: lonelytomb
 * Date: 6/3/17
 * Time: 12:16 AM
 */

if (Input::exists('get')) {
	echo Jasonify::toJson($_GET);
}