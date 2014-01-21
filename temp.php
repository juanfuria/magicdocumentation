<?php

include_once('framework/php/Framework.php');

$frw = new Framework();

//$doc = new Documentation("files/", $frw);



echo "<pre>";
print_r($frw->documentation->platforms['Android']->versions);
echo "</pre>";

//$frw->printSelectedPlatform();