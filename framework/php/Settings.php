<?php

class Settings extends Entity{
    public $baseUrl;
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



} 