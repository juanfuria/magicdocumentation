<?php

class Platform extends Entity{
    public $settings;
    public $sections;
    public $name;
    public $description;
    public $versions = array();


    function getSection($section_name){
        return $this->sections[$section_name];
    }

    function addVersion($version){
        if(!in_array($version, $this->versions)){
            $this->versions[count($this->versions)] = $version;
        }
    }
} 