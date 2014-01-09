<?php

class Entity
{

    public $_id;

    function BaseObject(){}

    public function getId()
    {
        return (string)$this->_id;
    }

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

    public function toEdit()
    {
        $vars       = get_object_vars($this);
        $classname  = get_class($this);
        $id = $this->getId();
        $form       = new Form("form" . $id, "form" . $id, null, "javascript:void(null);", false);
        foreach($vars as $key => $value)
        {
            $form->addField((($key=="_id") || ($key=="Date"))?"hidden":"text", "$id", "$id", (($value!=null)?(($key=="_id")?(string)$value:$value):""), "", "$key", "");
        }

        $ret = $form->toString();

        return $ret;
    }


}
