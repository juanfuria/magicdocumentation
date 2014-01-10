<?php

class File{
    public $name;
    public $path;
    public $ext;

    function File($path)
    {
        $fullFileName   = Utils::getStringAfterLast($path, "/");
        $this->name     = Utils::getStringBeforeLast($fullFileName, ".");
        $this->ext      = Utils::getStringAfterLast($fullFileName, ".");
        $this->path     = $path;
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

}