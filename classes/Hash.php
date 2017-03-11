<?php
class Hash
{
    public static function make($password,$salt = "")
    {
        return hash('sha256',$password . $salt);
    }

    public static function salt($length)
    {
        return random_bytes($length);
    }

    public static function unique()
    {
        return self::make(uniqid());
    }
}