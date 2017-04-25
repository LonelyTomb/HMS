<?php

namespace HMS\Processor;

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
        header("location: $path");
        exit;
    }
}