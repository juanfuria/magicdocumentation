<?php

set_include_path(realpath(dirname(__FILE__)));

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



        $this->settings     = Settings::Read('settings.conf');
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
            $return .= '    <link rel="stylesheet" href="' . $this->settings->getBaseUrl() . $css . '">' . "\n";
        }
        return $return;
    }

    public function getFormattedJavaScriptList(){
        $return = "";
        foreach($this->javascripts as $js){
            $return .= '    <script src="' . $this->settings->getBaseUrl() . $js . '"></script>' . "\n";
        }
        return $return;
    }

    public function printNavBar(){
        Layout::printNavBar($this->platforms, $this->getSelectedPlatform(), $this->settings);
    }

    public function printNavButtons(){
        Layout::printNavButtons($this->platforms, $this->getSelectedPlatform(), $this->settings);
    }

    public function getAjaxFunctions(){
        $return = '';
        $return .= Ajax::Register("saveMethod", "Method", '$("#xplayers").append(data.html);');

        $return .= 'function replaceData(data){
            if (typeof(data.replace) != \'undefined\') {
                $("#" + data.replace.id).replaceWith(data.replace.html);
            }
        }';

        $return = Utils::compress($return);

        echo "\t" . Utils::surroundWithtag("script", $return) . "\n";

    }
}

