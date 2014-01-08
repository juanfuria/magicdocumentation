<?php

class Utils {
    static function listDirs($dir){
        return glob($dir . '/*' , GLOB_ONLYDIR);
    }

    static function listFiles($dir, $extension){
        return glob($dir . '/*.' . $extension);
    }

    static function getStringAfterLast($str, $needle){
        return substr( $str, strrpos($str, $needle ) + 1 );
    }

    static function getStringBeforeLast($str, $needle){
        return substr($str, 0, strrpos($str, $needle));
    }

    static function getMergedInputArrays(){
        $sentVars = array();
        foreach($_GET as $key => $value){
            $sentVars[$key] = filter_input(INPUT_GET, $key);
        }
        foreach($_POST as $key => $value){
            $sentVars[$key] = filter_input(INPUT_POST, $key);
        }
        return $sentVars;
    }

    static function isValid($string)
    {
        return (($string != null) && ($string != '')) ? true : false;
    }

} 