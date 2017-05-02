<?php

namespace HMS\Processor;

use HMS\Processor\{
	Auth,Sessions,Input
}
;
Sessions::init();
/**
*Public Globally Available Parameters
 */
define("CONFIG", array(
    "customPath" => "/labs/HMS/"
        )
    );


Auth::logOut();