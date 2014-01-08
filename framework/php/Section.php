<?php

class Section
{
    public $name;
    public $files = array();
    private $path;

    function Section($name, $path = NULL){
        $this->name   = $name;
        if($path != NULL){
            $this->path   = $path;
            $tempFiles = Utils::listFiles($path, "html");
            foreach ($tempFiles as $file) {
                $this->files[$this->getFilesSize()] = new File($file);
            }
        }
    }

    function getFilesSize(){
        return count($this->files);
    }

    function getNameId(){
        $finalName = html_entity_decode($this->name);
        $finalName = str_ireplace(" ", "_", $finalName);
        $finalName = strtolower($finalName);
        return $finalName;
    }

    function printContent(){
        echo '<section id="section_' . $this->getNameId() . '">';
        echo '<h2>' . $this->name . '</h2>';

        /** @var $file File */
        foreach ($this->files as $file){
            echo '<div id="elem_' . $file->getNameId() . '">';
            echo $file->getContent();
            echo '</div>';
        }

        echo '</section>';
    }

} 