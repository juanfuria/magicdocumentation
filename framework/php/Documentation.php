<?php

class Documentation
{
    private $DEFAULT_ABOUT              = "About";
    private $DEFAULT_INFO               = "Info";
    private $DEFAULT_INTRODUCTION       = "Introduction";
    private $DEFAULT_GETTING_STARTED    = "Getting Started";

    /* var $sections Section */
    public $sections = array();

    public $specialFiles = array();
    private $framework;

    function Documentation($path, $framework)
    {
        //$x = 0;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_ABOUT;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_INFO;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_INTRODUCTION;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_GETTING_STARTED;

        $files    = Utils::listFiles($path, "html");
        $dirs     = Utils::listDirs($path);

        $this->handleSpecialFiles($files);

        foreach ($dirs as $sectionPath) {
            $name = Utils::getStringAfterLast($sectionPath, "/");
            $this->sections[$name] = new Section($name, $sectionPath, $framework);
        }
        $this->framework = $framework;
    }

    private function handleSpecialFiles($files){

       foreach ($this->specialFiles as $spfile) {
            $found = false;
            $x = 0;
            while(!$found && ($x < count($files))){
                if(stripos($files[$x], $spfile)){
                    $this->sections[$spfile] = $this->getSectionFromFile($spfile, new File($files[$x]));
                    $found = true;
                }
                $x++;
            }
        }
    }

    private function getSectionFromFile($sectionName, $file){
        $section = new Section($sectionName, NULL, $this->framework);
        $section->files[$section->getFilesSize()]   = $file;
        return $section;
    }

    function getSectionsSize(){
        return count($this->sections);
    }

    function printSectionContent($sectionName){
        if($this->hasSection($sectionName)){

            /** @var $section Section */
            $section = $this->sections[$sectionName];
            $section->printContent();
        }
    }

    function hasSection($sectionName){
        return array_key_exists($sectionName, $this->sections);
    }

    function printAll(){

        /** @var $section Section */
        foreach ($this->sections as $section) {
            $section->printContent();
        }

    }
}
