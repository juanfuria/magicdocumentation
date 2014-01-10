<?php

class Settings extends Entity{
    public $filesDir;
    public $frameworkDir;
    public $cssDir;
    public $jsDir;
    public $imgDir;
    public $pageTitle;
    public $urlStyle;


    function Settings(){
        /* $this->filesDir     = "files";
         $this->frameworkDir = "framework/";
         $this->cssDir       = $this->frameworkDir . "css";
         $this->jsDir 		= $this->frameworkDir . "js";
         $this->imgDir 		= $this->frameworkDir . "img";
         $this->pageTitle    = "Handpoint API";
         $this->urlStyle     = UrlType::URL_VARS;*/
    }

    function getSelfUrl(){
        return filter_input(INPUT_SERVER, "SCRIPT_FILENAME");
    }

    function getRoot(){
        return filter_input(INPUT_SERVER,"DOCUMENT_ROOT");
    }

    function getBaseUrl(){
        return Utils::getStringBeforeLast(str_ireplace($this->getRoot() , "", $this->getSelfUrl()), "index.php");
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