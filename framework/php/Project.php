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

        if(count($platform->versions) > 0){
            echo '<div class="version-info">
                        <span class="alert alert-info">You are currently viewing the documentation for version
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            ' . $platform->versions[0] . ' <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">';
                    foreach($platform->versions as $version){
                        echo '<li><a href="#">' . $version . '</a></li>';
                    }

              echo '        </ul>
                        </div>
                    </span>
                </div>';
        }

        /** @var $section Section */
        foreach ($platform->sections as $section) {
            $this->printSectionContent($platform->name, $section);
        }

    }

    function printSectionContent($platform_name, $section){

        $content = '<section id="section_' . Utils::camelCase($section->name) . '" class="escape-navbar">';
        $content.= '<div class="row" >
        <div class="col-sm-6 item-description">
        <h2>' . $section->name . '</h2></div>';

        //TODO fix horrible kludge
        if(!$section->special){
            $content.= '<div class="col-sm-6 item-example"></div>';
        }
        $content.= "</div>";


        if(isset($this->framework->sentVars['version'])){
            $version = $this->framework->sentVars['version'];
        }
        $count = 0;

        /** @var $file File */
        foreach ($section->files as $file){
            if(isset($version) && (($file->ext == 'json' &&  Utils::shouldPrintVersion($version, $file->json['version'])) || ($file->ext != 'json')) || (!isset($version))){
                $elemName = ($file->ext == 'json') ? $file->json['name'] : $file->name;
                $content.= '<div class="row escape-navbar" id="elem_' . Utils::camelCase($elemName) . '">';
                if($file->ext == 'json'){
                    $type = $file->json['type'];
                    $template = $this->framework->settings->getTemplate($type);
                    $view = new Template($this->framework->settings->getTemplatesDir() . "/" . $template . ".php");
                    $view->entities = $this->getPlatform($platform_name)->entities;
                    $view->json = $file->json;
                    $content.= $view;
                }
                else{
                    $content.= $file->content;
                }
                $content.= '</div>';
                $count++;

            }
        }

        $content.= '</section>';

        if($count > 0){
            echo $content;
        }
    }

}