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

    $vars = $framework->sentVars;
    $function = $vars['function'];
    $jsondata[] = array();

    switch($function)
    {
        case "editSettings":
            $jsondata[$RESPONSE_FIELD] = $settings->toForm();
            break;
        case "saveSettings":
            unset($vars['function']);
            $json = json_encode($vars);
            if(Utils::isJson($json)){
                Settings::Save("settings.conf", $json);
            }

            $jsondata[$RESPONSE_FIELD] = $json;
            break;
        case "editPlatform":
            if(!isset($vars['platform'])){
                die;
            }
            unset($vars['function']);



            $json = json_encode($framework->sentVars);


            $ent = new Entity();
            $ent->name = $vars['platform'];

            $classname = "Platform";
            $form = new Form($classname,$classname, "POST", "javascript:void(null);");
            $form->addField("text","name","$classname Name", $vars['platform'], "form-control uneditable-input", "$classname Name", "");
            $form->addField("button", $classname.".save","", "Save", "btn btn-success", null, "save$classname();");
            $form->addField("button",$classname.".cancel","", "Cancel", "btn btn-danger", null, "cancel$classname();");

            //$jsondata[$RESPONSE_FIELD] = $form->toString();*/

            $jsondata['replace']['id']      = "xplatform_" . Utils::camelCase($vars['platform']);
            $jsondata['replace']['html']    = $ent->toEdit();



            break;
    }

    echo json_encode($jsondata);
}

