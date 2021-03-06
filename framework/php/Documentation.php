<?php

class Documentation
{
    private $DEFAULT_ABOUT              = "About";
    private $DEFAULT_INFO               = "Info";
    private $DEFAULT_INTRODUCTION       = "Introduction";
    private $DEFAULT_GETTING_STARTED    = "Getting started";

    public  $projects        = array();
    public  $specialFiles    = array();
    private $framework;

    function Documentation($_path, $framework)
    {
        $this->framework = $framework;
        $this->initDefaults();

        $projects = Utils::listDirs($_path);

        foreach($projects as $project){

            $projectinfo            = pathinfo($project);
            $projectObj             = new Project();
            $projectObj->name       = $projectinfo['basename'];
            $projectObj->framework  = $framework;

            $this->projects[$projectObj->name] = $projectObj;

            $currentProject = $this->projects[$projectObj->name];

            $platforms = Utils::listDirs($project);
            foreach($platforms as $platform){
                $platforminfo       = pathinfo($platform);
                $platformObj        = new Platform();
                $platformObj->name  = $platforminfo['basename'];

                $currentProject->platforms[$platformObj->name] = $platformObj;

                /** @var $currentPlatform Platform */
                $currentPlatform = $currentProject->platforms[$platformObj->name];

                $settings = array();
                if(file_exists($platform . "/platform.json")){
                    $settings = json_decode(Utils::getContent($platform . "/platform.json"), true);
                }
                else{
                    foreach ($this->specialFiles as $key => $spFile) {
                        $settings['order'][$key] = $spFile;
                    }
                }
                $currentPlatform->settings = $settings;
//                if(isset($settings['title'])){
//                    $currentPlatform->name = $settings['title'];
//                }

                //We search for "sections" inside the platform
                $dirs = Utils::listDirs($platform);
                foreach ($dirs as $dir) {

                    $pathinfo           = pathinfo($dir);
                    $sectionObj         = new Section();

                    $sectionObj->name   = $pathinfo['basename'];
                    $sectionObj->path   = $pathinfo['dirname'];
                    $sectionObj->special= (in_array($sectionObj->name, $this->specialFiles));

                    $currentPlatform->sections[$sectionObj->name] = $sectionObj;

                    /** @var $currentSection Section */
                    $currentSection = $currentPlatform->sections[$sectionObj->name];

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
                            foreach($fileObj->json as $jsonItem){
                                if(array_key_exists('version', $jsonItem)){
                                    $version = $jsonItem['version'];
                                    $currentPlatform->addVersion($version);
                                    $entity = $jsonItem['name'];
                                    $currentPlatform->addEntity(Utils::camelCase($entity));
                                }
                            }
                        }
                        $pos = count($currentSection->files);
                        $currentSection->files[$pos] = $fileObj;
                    }

                    $currentSection->sort();

                }


                //order sections
                $sorted = array();
                $unsorted = [];

                foreach($currentPlatform->settings['order'] as $section_name){
                    if(array_key_exists($section_name , $currentPlatform->sections)){
                        $sorted[$section_name] = $currentPlatform->sections[$section_name];
                    }
                    else{
                        $unsorted[$section_name] = $currentPlatform->sections[$section_name];
                    }
                }
                foreach($sorted as $name => $sortedSection){
                    if(array_key_exists($name, $currentPlatform->sections)){
                        unset($currentPlatform->sections[$name]);
                    }
                }
                foreach($currentPlatform->sections as $name => $newSect){
                    $sorted[$name] = $newSect;
                }

                $currentPlatform->sections = $sorted;

                rsort($currentPlatform->versions, SORT_STRING);
                //end order sections
            }
        }
    }

    public function getSelectedProjectName(){
        return (isset($this->framework->sentVars["project"])) ? $this->framework->sentVars["project"] : $this->getListOfProjects()[0];
    }

    public function getSelectedProject(){

        return $this->projects[$this->getSelectedProjectName()];
    }

    public function getListOfProjects()
    {

        $projects = array();

        foreach ($this->projects as $project) {
            $projects[count($projects)] = $project->name;
        }
        return $projects;
    }

    private function initDefaults()
    {
        $this->specialFiles[] = $this->DEFAULT_ABOUT;
        $this->specialFiles[] = $this->DEFAULT_INFO;
        $this->specialFiles[] = $this->DEFAULT_INTRODUCTION;
        $this->specialFiles[] = $this->DEFAULT_GETTING_STARTED;
    }
}
