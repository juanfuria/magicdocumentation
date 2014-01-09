<?php
class Ajax{
    static $SEND_METHOD = "POST";
    static $DATA_TYPE   = "json";
    static $URL         = "./ajax.php";
    public static function Register($name, $className, $success, $attributes=array()){
        $attr = "";
        $attrstr = "";
        $x = 0;
        foreach ($attributes as $value)
        {
            if($x > 0)
                $attr .= ', ';
            $attr.=$value;
            if($x > 0)
                $attrstr .= ' + "';
            $attrstr .= '&' . $value . '=" + ' . $value;
            $x++;
        }

        if(Utils::isValid($attrstr))
            $attrstr = ' + "' . $attrstr;


        $ret = "
function $name($attr){
    $.ajax({
        data: \"function=$name" . (($className != null) ? '&" + $("#' . $className . '").serialize()': '"')  .  $attrstr . ",
        type: \"" . Ajax::$SEND_METHOD . "\",
        dataType: \"" . Ajax::$DATA_TYPE . "\",
        url: \"" . Ajax::$URL . "\",
        success: function(data){
           $success
        }
    });
}";
        return $ret;
    }
}