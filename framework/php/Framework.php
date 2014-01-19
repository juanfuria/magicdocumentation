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
        $this->stylesheets  = Utils::listFiles($this->settings->getCssDir(), "css");
        $this->javascripts  = Utils::listFiles($this->settings->getJsDir(), "js");
    }

    public function getListOfPlatforms(){

        $dirs = Utils::listDirs($this->settings->getFilesDir());
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

        return new Documentation($this->settings->getFilesDir() . "/" . $platform, $this);
    }

    public function printCssHeaders(){
        $return = "";
        $view = new Template($this->settings->getTemplatesDir() . "/css_header.php");
        foreach($this->stylesheets as $css){
            $view->url = $this->settings->getBaseUrl() . $css;
            $return .= $view;
        }
        echo $return;
    }

    public function printJavaScriptHeaders(){
        $return = "";
        $view = new Template($this->settings->getTemplatesDir() . "/js_header.php");
        foreach($this->javascripts as $js){
            $view->url = $this->settings->getBaseUrl() . $js;
            $return .= $view;
        }
        echo $return;
    }

    public function printNavBar(){

        $view = new Template($this->settings->getTemplatesDir() . "/navbar.php");

        $view->title = $this->settings->pageTitle;
        $items = array();
        $x = 0;

        foreach ($this->platforms as $platform) {
            $entity = new Template("");
            $url = '';
            if($this->settings->urlStyle == UrlType::URL_VARS){
                $url = $this->settings->getBaseUrl() . Utils::getStringAfterLast($_SERVER["PHP_SELF"], "/") . '?platform=' . $platform . '';
            }
            else if ($this->settings->urlStyle == UrlType::URL_READABLE){
                $url = $this->settings->getBaseUrl() . 'platform/' . $platform . '/';
            }
            $entity->url      = $url;
            $entity->platform = $platform;
            if($platform == $this->getSelectedPlatform()){
                $entity->class = 'class="active"';
            }

            $items[$x] = $entity;
            $x++;
        }
        $view->items = $items;
        echo $view;
    }

    public function printMenu(){

        $view = new Template($this->settings->getTemplatesDir() . "/menu.php");
        $doc = $this->getDocumentation($this->getSelectedPlatform());
        /** @var $section Section */
        $items = array();
        $x = 0;
        foreach ($doc->sections as $section) {
            $viewSection = new Template("");
            $viewSection->class = "active";
            $viewSection->url = '#section_' . htmlentities($section->getNameId());
            $viewSection->name = $section->name;
            if($section->getFilesSize() > 1){
                $viewSection->badge = '<span class="badge">' . $section->getFilesSize() . '</span>';
            }
            $items[count($items)] = $viewSection;

            if($section->getFilesSize() > 1){
                $subSection = new Template("");
                $subSection->badge = '<span class="badge">' . $section->getFilesSize() . '</span>';
                /** @var $file File */
                foreach ($section->files as $file) {

                    $subSection = new Template("");
                    $subSection->class = "list-group-subitem";
                    $subSection->url = '#elem_' . $file->getNameId();
                    $subSection->name = $file->name;

                    $items[count($items)] = $subSection;
                }
            }
        }
        $view->items = $items;
        echo $view;
    }

    public function printNavButtons(){
        Layout::printNavButtons($this->platforms, $this->getSelectedPlatform(), $this->settings);
    }

    public function printAjaxFunctions(){
        $return = '';
        $return .= Ajax::Register("saveMethod", "Method", '$("#xplayers").append(data.html);');
        $return .= Ajax::Register("saveSettings", "Settings", 'alert(data.html);location.reload();');
        $return .= Ajax::Register("cancelSettings", "Settings", 'location.reload();');
        $return .= Ajax::Register("editSettings", "Settings", '$("#xcontent").html(data.html);');

        $return .= 'function replaceData(data){
            if (typeof(data.replace) != \'undefined\') {
                $("#" + data.replace.id).replaceWith(data.replace.html);
            }
        }';

        $return = Utils::compress($return);

        echo "\t" . Utils::surroundWithtag("script", $return) . "\n";

    }
}

