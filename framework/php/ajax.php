<?php

if (!isset($_POST['function'])){
    die;
}
else
{
    require_once('Framework.php');
    $function = $GLOBALS['SENT_VARS']['function'];
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

