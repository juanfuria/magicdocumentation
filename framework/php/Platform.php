<?php

class Platform extends Entity{
    public $settings;
    public $sections;
    public $name;
    public $description;
    public $versions = array();
    public $entities    = array();


    function getSection($section_name){
        return $this->sections[$section_name];
    }

    function addVersion($version){
        if(!in_array($version, $this->versions)){
            $this->versions[] = $version;
        }
    }

    function addEntity($entity){
        if(!in_array($entity, $this->entities)){
            $this->entities[] = $entity;
        }
    }
} 