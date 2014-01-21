<?php

class Documentation
{
    private $DEFAULT_ABOUT              = "About";
    private $DEFAULT_INFO               = "Info";
    private $DEFAULT_INTRODUCTION       = "Introduction";
    private $DEFAULT_GETTING_STARTED    = "Getting started";

    //public $sections    = array();
    public $platforms   = array();
    public $magic;

    public $specialFiles = array();
    private $framework;

    function Documentation($_path, $framework)
    {
        $this->framework = $framework;
        $this->initDefaults();

        $platforms = Utils::listDirs($_path);

        foreach($platforms as $platform){
            $platforminfo       = pathinfo($platform);
            $platformObj        = new Platform();
            $platformObj->name  = $platforminfo['basename'];

            $this->platforms[$platformObj->name] = $platformObj;

            //We search for "sections" inside the platform
            $dirs = Utils::listDirs($platform);
            foreach ($dirs as $dir) {

                $pathinfo           = pathinfo($dir);
                $sectionObj         = new Section();

                $sectionObj->name   = $pathinfo['basename'];
                $sectionObj->path   = $pathinfo['dirname'];
                $sectionObj->special= (in_array($sectionObj->name, $this->specialFiles));

                $this->platforms[$platformObj->name]->sections[$sectionObj->name] = $sectionObj;

                if(file_exists($dir . "/platform.json")){
                    $settings = json_decode(Utils::getContent($dir . "/platform.json"));
                }
                else{
                    foreach ($this->specialFiles as $key => $spFile) {
                        $settings['order'][$key] = $spFile;
                    }
                }

                $this->platforms[$platformObj->name]->settings = $settings;

                //order sections
                $order = array();
                foreach($this->platforms[$platformObj->name]->settings['order'] as $section_name){
                    if(array_key_exists($section_name , $this->platforms[$platformObj->name]->sections)){
                        $order[count($order)] = $section_name;
                    }
                }

                $this->platforms[$platformObj->name]->sections = array_merge(array_flip($order), $this->platforms[$platformObj->name]->sections);
                //end order sections

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
                        //TODO
                        if(array_key_exists('version', $fileObj->json)){
                            $version = $fileObj->json['version'];
                            $this->platforms[$platformObj->name]->addVersion($version);
                        }
                    }
                    $pos = count($this->platforms[$platformObj->name]->sections[$sectionObj->name]->files);
                    $this->platforms[$platformObj->name]->sections[$sectionObj->name]->files[$pos] = $fileObj;
                }
            }
        }
    }

    private function addVersion($version){

    }


//    function getSectionsSize(){
//        return count($this->platforms[$platform_name]['sections']);
//    }

    function printSectionContent($section){
        echo '<section id="section_' . $section->getNameId() . '" class="escape-navbar">';
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

            echo '<div class="row escape-navbar" id="elem_' . $file->getNameId() . '">';
            if($file->ext == 'json'){

                $view = new Template($this->framework->settings->getTemplatesDir() . "/method_two_columns.php");
                $view->json = $file->json;
                echo $view;
            }
            else{
                echo $file->content;
            }
            echo '</div>';
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
            $this->printSectionContent($section);
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
