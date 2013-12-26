<?php

include_once('Utils.php');

function __autoload($classname) {
    $filename = $classname .".php";
    include_once($filename);
}

class Framework{

    public $sentVars;
    /** @var $settings Settings */
    public $settings;

    public $stylesheets;
    public $javascripts;

    public $platforms;

    function Framework(){
        $this->sentVars     = Utils::getMergedInputArrays();
        $this->settings     = new Settings();
        $this->platforms    = $this->getListOfPlatforms();
        $this->stylesheets  = Utils::listFiles($this->settings->cssDir, "css");
        $this->javascripts  = Utils::listFiles($this->settings->jsDir, "js");
    }

    private function getListOfPlatforms(){

        $dirs = Utils::listDirs($this->settings->filesDir);
        $platforms = array();

        foreach ($dirs as $path) {
            $platforms[count($platforms)] = Utils::getStringAfterLast($path, "/");
        }
        return $platforms;
    }

    public function getSelectedPlatform(){
        //TODO fix this last
        $requestedPos = false;
        if (isset($this->sentVars["platform"])) {
            $requestedPos = array_search($this->sentVars["platform"], $this->platforms);
        }
        if(count($this->platforms) == 0){
            die;
        }
        return ($requestedPos) ? $this->platforms[$requestedPos] : $this->platforms[0];
    }

    public function getDocumentation($platform){
        if(array_search($platform, $this->platforms) === false){
            die;
        }

        return new Documentation($this->settings->filesDir . "/" . $platform);
    }

    public function getFormattedCSSList(){
        $return = "";
        foreach($this->stylesheets as $css){
            $return .= '<link rel="stylesheet" href="' . $this->settings->baseUrl . $css . '">' . "\n";
        }
        return $return;
    }

    public function getFormattedJavaScriptList(){
        $return = "";
        foreach($this->javascripts as $js){
            $return .= '<script src="' . $this->settings->baseUrl . $js . '"></script>' . "\n";
        }
        return $return;
    }

    public function printNavBar(){
        Layout::printNavBar($this->platforms, $this->getSelectedPlatform(), $this->settings->baseUrl, $this->settings->urlStyle);
    }
}

