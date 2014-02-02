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
        case "editSettings":
            $jsondata[$RESPONSE_FIELD] = $settings->toForm();
            break;
        case "saveSettings":
            unset($framework->sentVars['function']);
            $json = json_encode($framework->sentVars);
            if(Utils::isJson($json)){
                Settings::Save("settings.conf", $json);
            }

            $jsondata[$RESPONSE_FIELD] = $json;
            break;
        case "editPlatform":
            unset($framework->sentVars['function']);
            $json = json_encode($framework->sentVars);

            $jsondata[$RESPONSE_FIELD] = $json;
            break;
    }

    echo json_encode($jsondata);
}

