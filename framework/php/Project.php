<?php

class Project extends Entity
{

    public $platforms = array();
    public $name;
    public $description;
    public $framework;


    public function getListOfPlatforms()
    {

        $platforms = array();

        foreach ($this->platforms as $platform) {
            $platforms[count($platforms)] = $platform->name;
        }
        return $platforms;
    }

    function getPlatform($platform_name){
        return $this->platforms[$platform_name];
    }


    public function getSelectedPlatformName(){
        $frw = $this->framework;
        return (isset($frw->sentVars["platform"])) ? $frw->sentVars["platform"] : $this->getListOfPlatforms()[0];
    }
    public function getSelectedPlatform(){
        return $this->platforms[$this->getSelectedPlatformName()];
    }

    function printAll($platform){

        /** @var $section Section */
        foreach ($platform->sections as $section) {
            $this->printSectionContent($platform->name, $section);
        }

    }

    function printSectionContent($platform_name, $section){
        echo '<section id="section_' . Utils::camelCase($section->name) . '" class="escape-navbar">';
        echo '<div class="row" >
        <div class="col-sm-6 item-description">
        <h2>' . $section->name . '</h2></div>';

        //TODO fix horrible kludge
        if(!$section->special){
            echo '<div class="col-sm-6 item-example"></div>';
        }
        echo "</div>";

        /** @var $file File */
        foreach ($section->files as $file){
            if(isset($this->framework->sentVars['version'])){
                $version = $this->framework->sentVars['version'];
            }
            if(isset($version) && (($file->ext == 'json' && $file->json['version'] == $version) || ($file->ext != 'json')) || (!isset($version))){
                $elemName = ($file->ext == 'json') ? $file->json['name'] : $file->name;
                echo '<div class="row escape-navbar" id="elem_' . Utils::camelCase($elemName) . '">';
                if($file->ext == 'json'){
                    $type = $file->json['type'];
                    $template = $this->framework->settings->getTemplate($type);
                    $view = new Template($this->framework->settings->getTemplatesDir() . "/" . $template . ".php");
                    $view->entities = $this->getPlatform($platform_name)->entities;
                    $view->json = $file->json;
                    echo $view;
                }
                else{
                    echo $file->content;
                }
                echo '</div>';
            }
        }

        echo '</section>';
    }

}