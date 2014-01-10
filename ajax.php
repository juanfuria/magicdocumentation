<?php

if (!isset($_POST['function'])){
    die;
}
else
{

    $RESPONSE_FIELD = "html";

    include_once('framework/php/Framework.php');
    $framework = new Framework();
    /** @var $settings Settings */
    $settings = $framework->settings;

    $function = $framework->sentVars['function'];
    $jsondata[] = array();

    switch($function)
    {
        case "saveSettings":



            $jsondata[$RESPONSE_FIELD] = json_encode($framework->sentVars);
        break;
    }

    echo json_encode($jsondata);
}

