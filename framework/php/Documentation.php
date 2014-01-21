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
        $this->initDefaults();

        $files = Utils::listFiles($path, "html");
        $dirs = Utils::listDirs($path);



        //$this->handleSpecialFiles($files);

        foreach ($dirs as $sectionPath) {
            $name = Utils::getStringAfterLast($sectionPath, "/");
            $this->sections[$name] = new Section($name, $sectionPath, $framework);

        }

        if(file_exists($path . "/platform.json")){
            $platformSettingsFile = new File($path . "/platform.json");
            $platformSettings = json_decode($platformSettingsFile->getContent(), true);
        }
        else{
            $platformSettings['sections'][0]['name'] = $this->DEFAULT_ABOUT;
            $platformSettings['sections'][0]['special'] = true;
            $platformSettings['sections'][1]['name'] = $this->DEFAULT_INFO;
            $platformSettings['sections'][1]['special'] = true;
            $platformSettings['sections'][2]['name'] = $this->DEFAULT_INTRODUCTION;
            $platformSettings['sections'][2]['special'] = true;
            $platformSettings['sections'][3]['name'] = $this->DEFAULT_GETTING_STARTED;
            $platformSettings['sections'][3]['special'] = true;
        }

        $order = array();
        foreach($platformSettings['sections'] as $key => $section){
            if(array_key_exists($section['name'] , $this->sections)){
                $order[count($order)] = $section['name'];
            }

            if(isset($section['special'])){
                if(array_key_exists($section['name'] , $this->sections)){
                    $this->sections[$section['name']]->special = true;
                }
            }
        }

        $this->sections = array_merge(array_flip($order), $this->sections);

        $this->framework = $framework;
    }


    private function handleSpecialFiles($files){

       foreach ($this->specialFiles as $spfile) {
            $found = false;
            $x = 0;
            while(!$found && ($x < count($files))){
                if(stripos($files[$x], $spfile)){
                    $this->sections[$spfile] = $this->getSectionFromFile($spfile, new File($files[$x]));
                    $this->sections[$spfile]->special = true;
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

    private function initDefaults()
    {
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_ABOUT;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_INFO;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_INTRODUCTION;
        $this->specialFiles[count($this->specialFiles)] = $this->DEFAULT_GETTING_STARTED;
    }
}
