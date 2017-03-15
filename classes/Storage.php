<?php
class Storage
{
    public static function fileExists($directoryPath)
    {
        return (file_exists($directoryPath)) ? true : false;
    }

    public static function makeDir($directoryPath)
    {
        if(!self::fileExists($directoryPath)){
            mkdir($directoryPath);
        }
    }
}