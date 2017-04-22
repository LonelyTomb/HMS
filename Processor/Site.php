<?php

namespace HMS\Processor;

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
    public static function setRoot(){
        self::$root = "http://".$_SERVER['SERVER_NAME'];
        if($_SERVER['SERVER_PORT'] != "80")
            self::$root .= $_SERVER['SERVER_PORT'];
        self::$root.="/labs/HMS/";
    }
    /**
     * Gets absolute http address
     *
     * @return void
     */
    public static function getRoot(){
        self::setRoot();
        return self::$root;
    }
    /**
     * Set Absolute Server path
     *
     * @return void
     */
    public static function setAbsPath(){
        self::$absPath = $_SERVER['DOCUMENT_ROOT']."/labs/HMS/";
    }
    /**
     * Gets Absolute Server path
     *
     * @return void
     */
    public static function getAbsPath(){
        self::setAbsPath();
        return self::$absPath;
    }
    /**
     * require using absolute path
     *
     * @param string $path
     * @return void
     */
    public static function reqAbs(string $path){
        require self::getAbsPath().$path;
    }
    /**
     * Sets Page Title
     *
     * @param string $title
     * @return void
     */
    public static function pageTitle(string $title){
        self::$title = $title;
    }
    /**
     * Prints Page Title
     *
     * @return void
     */
    public static function getPageTitle(){
        echo self::$title;
    }
}