<?php

include_once('framework/php/Framework.php');

$frw = new Framework();

//$doc = new Documentation("files/", $frw);



echo "<pre>";
print_r($frw->getSelectedPlatform());
echo "</pre>";

//$frw->printSelectedPlatform();