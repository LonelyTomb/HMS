<?php

namespace HMS\Processor;

Class Jasonify
{

    public static function toJson( $arr )
    {
        return utf8_encode(json_encode($arr, JSON_PRETTY_PRINT));
    }

    public static function toArray( $json )
    {
        return json_decode($json, true);
    }

}