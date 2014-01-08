<?php

class Settings {
    public $baseUrl;
    public $selfUrl;
    public $filesDir;
    public $root;
    public $app_root;
    public $frameworkDir;
    public $cssDir;
    public $jsDir;
    public $imgDir;
    public $pageTitle;
    public $urlStyle;
    public $navBarTitle;

    function Settings(){
        $this->filesDir     = "files";
        $this->selfUrl      = filter_input(INPUT_SERVER, "SCRIPT_FILENAME");
        $this->root         = filter_input(INPUT_SERVER,"DOCUMENT_ROOT");
        $this->baseUrl      = Utils::getStringBeforeLast(str_ireplace($this->root , "", $this->selfUrl), "index.php");
        $this->app_root     = str_ireplace($this->root, "", $this->baseUrl);
        $this->frameworkDir = "framework/";
        $this->cssDir       = $this->frameworkDir . "css";
        $this->jsDir 		= $this->frameworkDir . "js";
        $this->imgDir 		= $this->frameworkDir . "img";
        $this->pageTitle    = "Handpoint API";
        $this->urlStyle     = UrlType::URL_VARS;
    }

} 