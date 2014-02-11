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

    public $documentation;
    public $edit = false;

    function Framework($fetchdoc = true){
        $this->sentVars     = Utils::getMergedInputArrays();
        $this->settings     = Settings::Read('settings.conf');
        $this->stylesheets  = Utils::listFiles($this->settings->getCssDir(), "css");
        $this->javascripts  = Utils::listFiles($this->settings->getJsDir(), "js");
        if($fetchdoc){
            $this->documentation= new Documentation($this->settings->getFilesDir(), $this);
        }
    }

//    public function getDocumentation($platform){
//        if(array_search($platform, $this->platforms) === false){
//            die;
//        }
//
//        return new Documentation($this->settings->getFilesDir() . "/" . $platform, $this);
//    }

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

    /*TODO this should not be here*/
    public function printNavBar(){

        $view = new Template($this->settings->getTemplatesDir() . "/navbar.php");

        $view->title = $this->settings->pageTitle;
        $items = array();
        $x = 0;

        /** @var  $project Project */
        $project = $this->documentation->getSelectedProject();

        foreach ($project->platforms as $platform) {
            $entity = new Template("");
            $url = '';
            if($this->settings->urlStyle == UrlType::URL_VARS){
                $url = $this->settings->getBaseUrl() . Utils::getStringAfterLast($_SERVER["PHP_SELF"], "/") . '?platform=' . $platform->name . '';
            }
            else if ($this->settings->urlStyle == UrlType::URL_READABLE){
                $url = $this->settings->getBaseUrl() . 'platform/' . $platform->name . '/';
            }
            $entity->url      = $url;
            $entity->platform = $platform->name;
            if($platform->name == $project->getSelectedPlatformName()){
                $entity->class = 'class="active"';
            }
            if($this->edit){
                $entity->url = 'javascript:editPlatform(\'' . $entity->platform . '\');';
            }

            $items[$x] = $entity;
            $x++;
        }
        $view->items = $items;
        echo $view;
    }

    public function printMenu(){

        $view = new Template($this->settings->getTemplatesDir() . "/menu.php");
        /** @var  $project Project */
        $project = $this->documentation->getSelectedProject();
        /** @var  $platform Platform*/
        $platform = $project->getSelectedPlatform();
        $items = array();
        /** @var $section Section */
        foreach ($platform->sections as $section) {
            $viewSection = new Template("");
            $viewSection->class = "active";
            $viewSection->url = '#section_' . htmlentities(Utils::camelCase($section->name));
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

                    $elemName = ($file->ext == 'json') ? $file->json['name'] : $file->name;

                    $subSection = new Template("");
                    $subSection->class = "list-group-subitem";
                    $subSection->url = '#elem_' . Utils::camelCase($elemName);
                    $subSection->name = $file->name;

                    $items[count($items)] = $subSection;
                }
            }
        }
        $view->items = $items;
        echo $view;
    }

    public function printNavButtons(){
        $selectedProject = $this->documentation->getSelectedProject();
        $platformNames = $selectedProject->getListOfPlatforms;
        $selectedPlatform = $selectedProject->getSelectedPlatform();
        Layout::printNavButtons($platformNames, $selectedPlatform, $this->settings);
    }
    /*TODO End this shoud not be here */

    public function printAjaxFunctions(){
        $return = '';
        $return .= Ajax::Register("saveMethod", "Method", '$("#xplayers").append(data.html);');
        $return .= Ajax::Register("saveSettings", "Settings", 'alert(data.html);location.reload();');
        $return .= Ajax::Register("cancelSettings", "Settings", 'location.reload();');
        $return .= Ajax::Register("editSettings", "Settings", '$("#xcontent").html(data.html);');
        //$return .= Ajax::Register("editPlatform", "", 'replaceData(data);', array("platform"));
        $return .= Ajax::Register("savePlatform", "Platform", 'location.reload();');
        $return .= Ajax::Register("cancelPlatform", "Platform", 'location.reload();');
        $return .= 'function replaceData(data){
            if (typeof(data.replace) != \'undefined\') {
                $("#" + data.replace.id).replaceWith(data.replace.html);
            }
        };';
//        $return .= '
//        $(\'#xnavbar li a\').dblclick(function() {
//                editPlatform($(this).attr(\'id\'));
//                event.preventDefault();
//            });';

        $return = Utils::compress($return);

        echo "\t" . Utils::surroundWithtag("script", $return) . "\n";

    }

    public function printSelectedPlatform(){
        /** @var  $project Project */
        $project = $this->documentation->getSelectedProject();
        $project->printAll($project->getSelectedPlatform());
    }
}

