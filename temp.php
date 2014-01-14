<?php

include_once('framework/php/Framework.php');


$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;


$view = new Template("framework/templates/method.php");

$view->title = "Hello world!";
$view->description = "This is a ridiculously simple template";

echo $view;