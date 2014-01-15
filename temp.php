<?php

include_once('framework/php/Framework.php');


$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;


$view = new Template("framework/templates/method_two_columns.php");

$file = new File("files/Android/Transactions/Sale.html");
$json = $file->getContent();

$param = array();
$param[0]["name"] = "asd";
$param[0]["type"] = "789";
$param[0]["validation"] = "456";
$param[0]["notes"] = "123";


$view->parameters = $param;
$view->json = json_decode($json, true);

echo "<pre>";
print_r($view->json );
echo "</pre>";
echo $view;