<?php

class Settings extends Entity{
    public $pageTitle;
    public $urlStyle;


    function Settings(){
    }

    function getCssDir(){
        return $this->getFrameworkDir() . "/" . "css";
    }

    function getJsDir(){
        return $this->getFrameworkDir() . "/" . "js";
    }

    function getImgDir(){
        return $this->getFrameworkDir() . "/" . "img";
    }

    function getFilesDir(){
        return "files";
    }

    function getTemplatesDir(){
        return $this->getFrameworkDir() . "/" . "templates";
    }

    function getFrameworkDir(){
        return "framework";
    }

    function getSelfUrl(){
        return filter_input(INPUT_SERVER, "SCRIPT_FILENAME");
    }

    function getRoot(){
        return filter_input(INPUT_SERVER,"DOCUMENT_ROOT");
    }

    function getBaseUrl(){
        //return Utils::getStringBeforeLast(str_ireplace($this->getRoot() , "", $this->getSelfUrl()), "index.php") . "/";
        return Utils::getStringBeforeLast($_SERVER["SCRIPT_NAME"], "index.php");
    }

    function getAppRoot(){
        return str_ireplace($this->getRoot(), "", $this->getBaseUrl());
    }
    public static function Read($path){
        $settingsContent    = file_get_contents($path);
        $json               = json_decode($settingsContent, true);
        $settings           = new Settings();
        foreach($settings as $key => $value){
            $settings->$key = $json[$key];
        }
        return $settings;
    }

    public static function Save($path, $settings){
        file_put_contents($path, $settings);
    }


} 