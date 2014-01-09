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
        case "getCal":
            $year = substr($GLOBALS['SENT_VARS']['nextDate'], 0, 4);
            $month = substr($GLOBALS['SENT_VARS']['nextDate'], 4, 2);

            $jsondata['html'] = calendario($year, $month, DB::getPostDates($year, $month));
        break;
    }

    echo json_encode($jsondata);
}

