<?php

namespace HMS\Processor;

use DateTimeZone;
use DateTime;

Class Time
{
    public static $dateTime;
    public static function setDateTime($when,$format='Y-m-d H:i:s')
    {

        $utcTZ = new DateTimeZone('UTC');
        $utcDT = new DateTime($when, $utcTZ);
        return $utcDT->format($format);
    }


    // public static function getDateTime($dateTime, $localTimeZone)
    // {
    //     $utcTZ = new DateTimeZone($localTimeZone);
    //     $utcDT = new DateTime($dateTime, $utcTZ);
    //     return $utcDT->format('Y-m-d H:i:s');
    // }

    // public static function getCurrentDateTime($format){
    //     self::$dateTime = new DateTime();
    //     self::$dateTime = 
    // }
}