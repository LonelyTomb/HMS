<?php

namespace HMS\Processor;
use HMS\Processor\Site;

class Functions {
    /**
     * Escapes given string
     *
     * @param string $item
     * @return void
     */
    public static function escape(string $item){
        $item = trim($item);
        $item = stripslashes($item);
        $item = htmlentities($item);
        return $item;
    }
    /**
     * Redirect to given path
     *
     * @param string $path
     * @return void
     */
    public static function redirect(string $path){
        $path = Site::getRoot().$path;
        header("location: $path");
        exit;
    }
    /**
     * Looks for an item within a multidimensional array
     * or return false if no found
     *
     * @param $array
     * @param  $item
     */
    public static function get($array, $item){
        // if (!is_array($array)) return false;
        if(isset($array[$item])) return $array[$item];
        foreach($array as $key => $subArray){
            if(isset($subArray[$item])) return $subArray[$item];
        }
        return false;
    }
    public static function toast(string $item,int $time=4000){
        echo "<script>Materialize.toast('{$item}',{$time})</script>";
    }
}