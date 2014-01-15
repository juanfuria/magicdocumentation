<?php

class Section
{
    public $name;
    public $files = array();
    private $path;
    /**
     * @var null
     */
    private $framework;

    function Section($name, $path = NULL, $framework = NULL){
        $this->name   = $name;
        if($path != NULL){
            $this->path   = $path;
            $tempFiles = Utils::listFiles($path, "html");
            foreach ($tempFiles as $file) {
                $this->files[$this->getFilesSize()] = new File($file);
            }
        }
        $this->framework = $framework;
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


        echo '<section id="section_' . $this->getNameId() . '" class="escape-navbar">';
        echo '<div class="row" >
        <div class="col-md-6 item-description">
        <h2>' . $this->name . '</h2></div><div class="col-md-6 item-example"></div></div>';

        /** @var $file File */
        foreach ($this->files as $file){


            echo '<div class="row escape-navbar" id="elem_' . $file->getNameId() . '">';
            $content = $file->getContent();
            if(Utils::isJson($content)){
                $view = new Template($this->framework->settings->templatesDir . "/method_two_columns.php");
                $view->json = json_decode($content, true);
                echo $view;
            }
            else{
                echo $content;
            }
            echo '</div>';
        }

        echo '</section>';
    }

} 