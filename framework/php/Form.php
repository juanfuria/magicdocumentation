<?php

class Form
{
    private $attributes;
    private $fields;
    //private $buttons;
    private $legend;
    
    function Form($id, $name, $method, $action, $legend = true)
    {
        $this->attributes = array();
        $this->fields     = array();
        $this->legend       = $legend;
        //$this->buttons    = array();
        if(Utils::isValid($method))
            $this->attributes['method'] = $method;
        if(Utils::isValid($id))
            $this->attributes['id'] = $id;
        if(Utils::isValid($name))
            $this->attributes['name'] = $name;
        if(Utils::isValid($action))
            $this->attributes['action'] = $action;
        
    }
    
    public function addField($type, $id, $name, $value, $class, $label, $onclick)
    {
        $this->fields[count($this->fields)] = new FormField($type, $id, $name, $value, $class, $label,$onclick);
    }
    
    public function addFieldManually($field)
    {
        $this->fields[count($this->fields)] = $field;
    }
    
    public function addDropDown($name, $items, $placeholder)
    {
        $this->fields[count($this->fields)] = new DropDown($name, $items, $placeholder);
    }
    
    public function header()
    {
        $ret = "<legend>Add " . $this->attributes['name'] . "</legend>\n";
        $ret .= '<form';
        foreach($this->attributes as $key=>$value)
        {
            $ret .= ' ' . $key . '="' . $value . '"';
        }
        $ret .= '>'. "\n";
        return $ret;
    }
    public function close()
    {
        $ret = '</form>'. "\n";
        return $ret;
    }
    public function toString()
    {
        $ret ="";
        if($this->legend)
            $ret .= "<legend>" . $this->attributes['name'] . "</legend>\n";
        $ret .= '<form';
        foreach($this->attributes as $key=>$value)
        {
            $ret .= ' ' . $key . '="' . $value . '"';
        }
        $ret .= '>'. "\n";
        
        foreach($this->fields as $field)
        {
            $ret .= $field->toString() . "\n";
        }
        
        $ret .= '</form>'. "\n";
        return $ret;
    }
    
    public static function fromObject($object, $actioncancel, $actionsave)
    {
        $vars       = get_object_vars($object);
        $classname  = get_class($object);
        $form       = new Form($classname, $classname, null, "javascript:void(null);");
        foreach($vars as $key => $value)
        {
           Form::fromArrayValue($form,$key,$value);
        }
        $form->addField("button", $classname.".save","", "Save", "btn btn-success", null, $actionsave."();");
        $form->addField("button",$classname.".cancel","", "Cancel", "btn btn-danger", null, $actioncancel."();");
        return $form;
    }
    
    public static function fromArrayValue($form, $key, $value)
    {
//         if(is_array($value))
//        {
//            $form->addLegend($key);
//            foreach ($value as $subkey=>$subvalue)
//            {
//                $form->addDropDown , $subkey, $subvalue);
//            }
//        }
////        else if()
////        {
////            
////        }
//        else
             $form->addField((($key=="_id") || ($key=="Date"))?"hidden":"text", "$key", "$key", (($value!=null)?$value:""), "input-large uneditable-input", "$key", "");
    }
}

class FormField
{
    private $attributes;
            
    function FormField($type, $id, $name, $value, $class, $label, $onclick = null)
    {
        $this->attributes = array();
        if(Utils::isValid($type))
            $this->attributes['type'] = $type;
        if(Utils::isValid($id))
            $this->attributes['id'] = $id;
        if(Utils::isValid($name))
            $this->attributes['name'] = $name;
        if(Utils::isValid($value))
            $this->attributes['value'] = $value;
        if(Utils::isValid($class))
            $this->attributes['class'] = $class;
        if((Utils::isValid($label)) && (Utils::isValid($id))) //&& not hidden && not button
            $this->attributes['placeholder'] = $label;
        else
            $this->label = null;
        if(Utils::isValid($onclick))
            $this->attributes['onclick'] = $onclick;
    }

    
    public function toString()
    {   $ret = '';
        if($this->attributes['type'] != "hidden" && $this->attributes['type'] != "button")
            $ret .= '<div class="form-group">';
        if($this->attributes['type'] != "hidden")
        $ret .= '<label for="' . $this->id . '">' . $this->attributes['name'] . '</label>';
        $ret .= '<input';
        foreach($this->attributes as $key=>$value)
        {
            $ret .= ' ' . $key . '="' . $value . '"';
        }
        $ret .= ' />';
        if($this->attributes['type'] != "hidden" && $this->attributes['type'] != "button")
            $ret .= '</div>';
        return $ret;   
    }
}

class DropDown extends Form
{
    private $name;
    private $items;
    private $placeholder;
    function DropDown($name, $items, $placeholder = "")
    {
        $this->name = $name;
        $this->items = $items;
        $this->placeholder = $placeholder;
    }
    
    public function toString()
    {
        $ret = "<select id='$this->name' name='$this->name'>";
        if(Utils::isValid($this->placeholder))
            $ret .= "<option value='' disabled selected>$this->placeholder</option>";
        foreach ($this->items as $key => $value)
        {
            $ret .="<option value='$key'>$value</option>";
        }
        $ret .= "</select>";
        
        return $ret;
    }
}

class LineBreak extends Form
{
    function LineBreak(){}
    
    public function toString(){
        return "<br />\r\n";
    }
}

/*class Label
{
    private $id;
    private $text;
    
    function Label($id, $text)
    {
        $this->id   = $id;
        $this->text = $text;
    }
    
    public function toString()
    {
        return "<label for='$this->id'>$this->text</label>";
    }
}

class Button
{
    public $id;
    public $text;
    public $class;
    public $color;
    public $image;
    public $onclick;

    function Button($_id, $_text, $_class, $_color, $_image, $_onclick)
    {
        $this->id       = $_id;
        $this->text     = $_text;
        $this->class    = $_class;
        $this->color    = $_color;
        $this->image    = $_image;
        $this->onclick  = $_onclick;

    }

    public function toString()
    {
        // id="' . $this->id . '" name="' . $this->id . '"
        $eclass ="button";
        if($this->color != '')
            $eclass .= ' ' . $this->color;

        if($this->image != '')
                $eclass .= ' ' . $this->image;

        if($this->class != '')
                $eclass .= ' ' . $this->class;

        $idaddin = $this->id;
        if($idaddin != "")
            $idaddin = 'id="' . $idaddin . '" ';
        
        $return = '<input ' . $idaddin . ' type="button" class="' . $eclass . '" value="' . $this->text . '" onclick="' . $this->onclick . '"/>';
        return $return;
    }

}*/
?>
