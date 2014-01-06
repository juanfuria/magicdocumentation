<?php

class Documentation
{
    private $DEFAULT_INTRODUCTION = "Introduction";
    private $DEFAULT_GETTING_STARTED = "Getting Started";

    /* var $sections Section */
    public $sections = array();

    function Documentation($path)
    {
        $files    = Utils::listFiles($path, "html");
        $dirs     = Utils::listDirs($path);

        $this->handleSpecialFiles($files);

        foreach ($dirs as $sectionPath) {
            $name = Utils::getStringAfterLast($sectionPath, "/");
            $this->sections[$name] = new Section($name, $sectionPath);
        }
    }

    //Hacky dirty trick
    private function handleSpecialFiles($files){
        foreach ($files as $file) {
            $name = $this->DEFAULT_INTRODUCTION;
            if(stripos($file, $name)){
                $this->sections[$name] = $this->getSectionFromFile($name, new File($file));
            }
        }
        foreach ($files as $file) {
            $name = $this->DEFAULT_GETTING_STARTED;
            if(stripos($file, $name)){
                $this->sections[$name] = $this->getSectionFromFile($name, new File($file));
            }
        }

    }

    private function getSectionFromFile($sectionName, $file){
        $section = new Section($sectionName);
        $section->files[$section->getFilesSize()]   = $file;
        return $section;
    }

    function getSectionsSize(){
        return count($this->sections);
    }

    function printMenu($baseUrl){
        /** @var $section Section */
        echo '<ul class="list-group">';
        foreach ($this->sections as $section) {
            $badge = "";
            if($section->getFilesSize() > 1){
                $badge = '<span class="badge">' . $section->getFilesSize() . '</span>';
            }
            echo '<li class="list-group-item alert-info">' . $badge . '<a href="#section_' . htmlentities($section->getNameId()) . '">' . $section->name . '</a></li>';
            if($section->getFilesSize() > 1){

                /** @var $file File */
                foreach ($section->files as $file) {
                    echo '<li class="list-group-item list-group-subitem">' . '<a href="#elem_' . $file->getNameId() . '">' . $file->name . '</a></li>';
                }
            }
        }
        echo '</ul>';
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
