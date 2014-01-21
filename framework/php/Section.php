<?php

function cmp($a, $b) {
    $sortby = 'order'; //define here the field by which you want to sort
    return strcmp(json_decode($a->getContent(), true)[$sortby] , json_decode($b->getContent(), true)[$sortby]);
}
class Section
{
    public $name;
    public $files = array();
    public $special = false;
    private $path;
    /**
     * @var null
     */
    private $framework;

    //TODO fix this horrible thing
    function Section($name, $path = NULL, $framework = NULL){
        $this->name   = $name;
        if($path != NULL){
            $this->path   = $path;
            $tempFiles = Utils::listFiles($path, "json");
            foreach ($tempFiles as $file) {
                $this->files[$this->getFilesSize()] = new File($file);
            }
           // uasort($this->files, 'cmp');

            $htmlFiles = Utils::listFiles($path, "html");
            foreach ($htmlFiles as $file) {
                $this->files[$this->getFilesSize()] = new File($file);
            }


            echo "<pre>";
            print_r($this);
            echo "</pre>";

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
        <h2>' . $this->name . '</h2></div>';

        //TODO fix horrible kludge
        if(!$this->special){
            echo '<div class="col-md-6 item-example"></div>';
        }
        echo "</div>";

        /** @var $file File */
        foreach ($this->files as $file){
            $content = $file->getContent();
            $isJson = Utils::isJson($content);

            echo '<div class="row escape-navbar" id="elem_' . $file->getNameId() . '">';
            if($isJson){
                $view = new Template($this->framework->settings->getTemplatesDir() . "/method_two_columns.php");
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