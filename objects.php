<?php

include_once 'functions.php';
class Documentation
{
    private $DEFAULT_INTRODUCTION = "Introduction";
    private $DEFAULT_GETTING_STARTED = "Getting Started";
    public $sections = array();

    function Documentation($path)
    {
        $files    = listFiles($path, "html");
        $dirs     = listDirs($path);
        
        $this->handleSpecialFiles($files);
        
        foreach ($dirs as $sectionPath) {
            $name = getStringAfterLast($sectionPath, "/");
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
        foreach ($this->sections as $section) {
            $badge = "";
            if($section->getFilesSize() > 1){
                $badge = '<span class="badge">' . $section->getFilesSize() . '</span>';
            }
            echo '<li class="list-group-item">' . $badge . '<a href="' . $baseUrl . '/section/' . htmlentities($section->name) . '/">' . $section->name . '</a></li>';
            if($section->getFilesSize() > 1){
                foreach ($section->files as $file) {
                    echo '<li class="list-group-item list-group-subitem">' . '<a href="#' . $file->getNameId() . '">' . $file->name . '</a></li>';   
                }
            }
        }
    }
    
    function printSectionContent($sectionName){
        if($this->hasSection($sectionName)){
            $section = $this->sections[$sectionName];
            $section->printContent();
        }        
    }
    
    function hasSection($sectionName){
        return array_key_exists($sectionName, $this->sections);
    }
}


class Section
{
    public $name;
    public $files = array();
    private $path;

    function Section($name, $path = NULL){
      $this->name   = $name;
      if($path != NULL){
        $this->path   = $path;
        $tempFiles = listFiles($path, "html");
        foreach ($tempFiles as $file) {
            $this->files[$this->getFilesSize()] = new File($file);          
        }
      }
    }
    
    function getFilesSize(){
        return count($this->files);
    }
    
    private function getNameId(){
        $finalName = html_entity_decode($this->name);
        $finalName = str_ireplace(" ", "_", $finalName);
        $finalName = strtolower($finalName);
        return $finalName;
    }
    
    function printContent(){
        echo '<section id="' . $this->getNameId() . '">';
        foreach ($this->files as $file){
            echo '<div id="' . $file->getNameId() . '">';
            echo file_get_contents ($file->path);
            echo '</div>';
        }
        
        echo '</section>';
    }

}

class File{
    public $name;
    public $path;

    function File($path)
    {
        $fullFileName   = getStringAfterLast($path, "/");
        $this->name     = getStringBeforeLast($fullFileName, ".");
        $this->path     = $path;
    }
            
    function getNameId(){
        $finalName = html_entity_decode($this->name);
        $finalName = str_ireplace(" ", "_", $finalName);
        $finalName = strtolower($finalName);
        return $finalName;
    }
    
}
