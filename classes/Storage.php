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

    public static function deleteFile($filePath)
    {
        if(self::fileExists($filePath)){
            if(unlink($filePath)){
                return true;
            }
            return false;
        }
    }
}