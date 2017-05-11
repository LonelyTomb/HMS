<?php

namespace HMS\Processor;

Sessions::init();
/**
 *Public Globally Available Parameters
 */
define('CONFIG', array(
		'customPath' => '/labs/HMS/public/'
	)
);


Auth::logOut();