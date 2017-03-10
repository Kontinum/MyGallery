<?php
class Config
{
    public static function get($path = null)
    {
        if($path){
            $config = $GLOBALS['config'];
            $parts = explode('/',$path);

            foreach ($parts as $part) {
                if(isset($config[$part])){
                    $config = $config[$part];
                }
            }
            return $config;
        }
        return false;
    }
}