<?php
class Hash
{
    public static function make($password)
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }

    public static function check($password,$hash)
    {
        return (password_verify($password,$hash)) ? true : false;
    }

    public static function unique()
    {
        return self::make(uniqid());
    }
}