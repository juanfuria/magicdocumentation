<?php

class File{
    public $path;
    public $name;
    public $ext;
    public $content;
    public $json;

    function File()
    {

    }

    function getNameId(){
        $finalName = html_entity_decode($this->name);
        $finalName = str_ireplace(" ", "_", $finalName);
        $finalName = strtolower($finalName);
        return $finalName;
    }

    public function getContent()
    {
        return file_get_contents ($this->path);
    }


    public function setContent($data)
    {
        return file_put_contents ($this->path, $data);
    }

}