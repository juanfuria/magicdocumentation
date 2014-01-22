<?php

function cmp($a, $b) {
    $sortby = 'order'; //define here the field by which you want to sort
    return ($a->json[$sortby] - $b->json[$sortby]);
}

class Section
{
    public $name;
    public $files = array();
    public $special = false;

    function getFilesSize(){
        return count($this->files);
    }

    function getNameId(){
        $finalName = html_entity_decode($this->name);
        $finalName = str_ireplace(" ", "_", $finalName);
        $finalName = strtolower($finalName);
        return $finalName;
    }

    function sort(){

        $tempFiles = array();
        $htmlFiles = array();
        foreach($this->files as $file){
            if($file->ext == 'json'){
                $tempFiles[] = $file;
            }
            else{
                $htmlFiles[] = $file;
            }
        }

        foreach ($tempFiles as $file) {
            $this->files[] = new File($file);
        }

        uasort($tempFiles, 'cmp');


        $this->files = $tempFiles + $htmlFiles;


    }

} 