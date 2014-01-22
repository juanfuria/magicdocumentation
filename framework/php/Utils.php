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

    static function isValid($string){
        return (($string != null) && ($string != '')) ? true : false;
    }

    public static function compress($buffer) {
        // remove comments
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        // remove tabs, spaces, newlines, etc.
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
        return $buffer;
    }

    public static function surroundWithtag($tag, $string){
        return "<$tag>" . $string . "</$tag>";
    }

    public static function isJson($string) {
        if(Utils::isValid($string)){
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }
        else{
            return false;
        }
    }

    public static function getNameId($name){
        $finalName = html_entity_decode($name);
        $finalName = str_ireplace(" ", "_", $finalName);
        $finalName = strtolower($finalName);
        return $finalName;
    }


    public static function getContent($path)
    {
        return file_get_contents ($path);
    }


    public static function setContent($path, $data)
    {
        return file_put_contents ($path, $data);
    }

    public static function arrayToObject($array){
        $object = new stdClass();
        foreach ($array as $key => $value)
        {
            $object->$key = $value;
        }
        return $object;
    }

    public static function camelCase($str, $exclude = array())
{
    // replace accents by equivalent non-accents
    $str = self::replaceAccents($str);
    // non-alpha and non-numeric characters become spaces
    $str = preg_replace('/[^a-z0-9' . implode("", $exclude) . ']+/i', ' ', $str);
    // uppercase the first character of each word
    $str = ucwords(trim($str));
    return lcfirst(str_replace(" ", "", $str));
}

public static function replaceAccents($str) {
    $search = explode(",",
        "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
    $replace = explode(",",
        "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");
    return str_replace($search, $replace, $str);
}

} 