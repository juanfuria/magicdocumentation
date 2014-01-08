<?php

class Method {

    public $_id;
    public $name;
    public $description;
//    private $parameters;
//    private $descriptionLists;
//    private $example;

    public function toForm()
    {
        $vars       = get_object_vars($this);
        $classname  = get_class($this);
        $form       = new Form($classname, $classname, null, "javascript:void(null);");
        foreach($vars as $key => $value)
        {
            $form->addField((($key=="_id") || ($key=="Date"))?"hidden":"text", "$key", "$key", (($value!=null)?(($key=="_id")?(string)$value:$value):""), "input-medium uneditable-input", "$key", "");
        }
        $form->addField("button", $classname.".save","", "Save", "btn btn-success", null, "save$classname();");
        $form->addField("button",$classname.".cancel","", "Cancel", "btn btn-danger", null, "cancel$classname();");

        return $form->toString();
    }
} 