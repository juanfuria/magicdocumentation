<?php

include_once('framework/php/Framework.php');


$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;

$png = Utils::listFiles("framework/img/ballicons/small/", "png");

print_r($png);