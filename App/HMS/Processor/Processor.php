<?php

namespace HMS\Processor;
/**
 * Initialize Session
 */
Sessions::init();
/**
 *Public Globally Available Parameters
 */
define('CONFIG', array(
		'customPath' => '/labs/HMS/public/'
	)
);

/**
 * Logs user out if logOut is set
 */
Auth::logOut();