<?php

include_once('framework/php/Framework.php');

function compress($buffer)
{
    // remove comments
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    // remove tabs, spaces, newlines, etc.
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;

$png = Utils::listFiles("framework/img/ballicons/small/", "png");
ob_start("compress");
echo ".ball{
    width: 128px;
    height 128px;
    min-width: 128px;
    min-height: 128px;
    position: relative;
    top: 1px;
    display: inline-block;
    background-repeat: no-repeat;
}";

foreach ($png as $value){
    $fullname = Utils::getStringAfterLast($value, "/");
    $name = Utils::getStringBeforeLast($fullname, ".");
    echo ".ball-$name{
        background: url('../img/ballicons/small/$fullname');
    }";
}

ob_end_flush();