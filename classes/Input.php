<?php
class Input
{
    public static function exists($type = "post")
    {
        switch ($type){
            case 'post' :
                return (!empty($_POST)) ? true : false;
            break;

            case 'get':
                return (!empty($_GET)) ? true : false;
            break;
        }
        return false;
    }

    public static function get($name,$filterName = "")
    {
        if(isset($_POST[$name])){
            return filter_input(INPUT_POST,$name,$filterName);
        }else if (isset($_GET[$name])){
            return filter_input(INPUT_GET,$name,$filterName);
        }else{
            return "";
        }
    }
}