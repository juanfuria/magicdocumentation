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
        echo '<div class="row" >
        <div class="col-md-6 item-description">
        <h2>' . $this->name . '</h2></div><div class="col-md-6 item-example"></div></div>';

        /** @var $file File */
        foreach ($this->files as $file){
            echo '<div class="row" id="elem_' . $file->getNameId() . '">';
            $content = $file->getContent();
            if(Utils::isJson($content)){
                Layout::printMethod($content);
            }
            else{
                echo $content;
            }
            echo '</div>';
        }

        echo '</section>';
    }

} 