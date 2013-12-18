<?php

function listDirs($dir){
    return glob($dir . '/*' , GLOB_ONLYDIR);
}

function listFiles($dir, $extension){
    return glob($dir . '/*.' . $extension);
}

function getStringAfterLast($str, $needle){
   return substr( $str, strrpos($str, $needle ) + 1 );
}

function getStringBeforeLast($str, $needle){
    return substr($str, 0, strrpos($str, $needle));
}

