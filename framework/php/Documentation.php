<?php

class Documentation
{
    private $DEFAULT_ABOUT              = "About";
    private $DEFAULT_INFO               = "Info";
    private $DEFAULT_INTRODUCTION       = "Introduction";
    private $DEFAULT_GETTING_STARTED    = "Getting started";

    //public $sections    = array();
    public $platforms   = array();

    public $specialFiles = array();
    private $framework;

    function Documentation($_path, $framework)
    {
        $this->framework = $framework;
        $this->initDefaults();

        $projects = Utils::listDirs($_path);

        foreach($projects as $project){

            $projectinfo       = pathinfo($project);
            $projectObj        = new Project();
            $projectObj->name  = $projectinfo['basename'];

            $this->projects[$projectObj->name] = $projectObj;

            $platforms = Utils::listDirs($project);
            foreach($platforms as $platform){
                $platforminfo       = pathinfo($platform);
                $platformObj        = new Platform();
                $platformObj->name  = $platforminfo['basename'];

                $this->platforms[$platformObj->name] = $platformObj;

                $settings = array();
                if(file_exists($platform . "/platform.json")){
                    $settings = json_decode(Utils::getContent($platform . "/platform.json"), true);
                }
                else{
                    foreach ($this->specialFiles as $key => $spFile) {
                        $settings['order'][$key] = $spFile;
                    }
                }
                $this->platforms[$platformObj->name]->settings = $settings;

                //We search for "sections" inside the platform
                $dirs = Utils::listDirs($platform);
                foreach ($dirs as $dir) {

                    $pathinfo           = pathinfo($dir);
                    $sectionObj         = new Section();

                    $sectionObj->name   = $pathinfo['basename'];
                    $sectionObj->path   = $pathinfo['dirname'];
                    $sectionObj->special= (in_array($sectionObj->name, $this->specialFiles));

                    $this->platforms[$platformObj->name]->sections[$sectionObj->name] = $sectionObj;

                    $files      = Utils::listFiles($dir, "*");
                    foreach ($files as $file) {
                        $fileinfo           = pathinfo($file);
                        $fileObj            = new File();
                        $fileObj->path      = $fileinfo['dirname'];
                        $fileObj->name      = $fileinfo['filename'];
                        $fileObj->ext       = $fileinfo['extension'];
                        $fileObj->content   = Utils::getContent($file);

                        if($fileObj->ext == 'json'){
                            $fileObj->json = json_decode($fileObj->content, true);
                            if(array_key_exists('version', $fileObj->json)){
                                $version = $fileObj->json['version'];
                                $this->platforms[$platformObj->name]->addVersion($version);
                                $entity = $fileObj->json['name'];
                                $this->platforms[$platformObj->name]->addEntity(Utils::camelCase($entity));
                            }
                        }
                        $pos = count($this->platforms[$platformObj->name]->sections[$sectionObj->name]->files);
                        $this->platforms[$platformObj->name]->sections[$sectionObj->name]->files[$pos] = $fileObj;
                    }

                    $this->platforms[$platformObj->name]->sections[$sectionObj->name]->sort();

                }


                //order sections
                $sorted = array();
                foreach($this->platforms[$platformObj->name]->settings['order'] as $section_name){
                    if(array_key_exists($section_name , $this->platforms[$platformObj->name]->sections)){
                        $sorted[$section_name] = $this->platforms[$platformObj->name]->sections[$section_name];
                    }
                }
                $this->platforms[$platformObj->name]->sections = $sorted;

                //end order sections
            }
        }
    }

    function printSectionContent($platform_name, $section){
        echo '<section id="section_' . Utils::camelCase($section->name) . '" class="escape-navbar">';
        echo '<div class="row" >
        <div class="col-md-6 item-description">
        <h2>' . $section->name . '</h2></div>';

        //TODO fix horrible kludge
        if(!$section->special){
            echo '<div class="col-md-6 item-example"></div>';
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

    function getPlatform($platform_name){
        return $this->platforms[$platform_name];
    }

    /*function hasSection($sectionName){
        return array_key_exists($sectionName, $this->platforms[$platform_name]['sections']);
    }*/

    function printAll($platform_name){

        /** @var $section Section */
        foreach ($this->platforms[$platform_name]->sections as $section) {
            $this->printSectionContent($platform_name, $section);
        }

    }

    private function initDefaults()
    {
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_ABOUT;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_INFO;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_INTRODUCTION;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_GETTING_STARTED;
    }
}
