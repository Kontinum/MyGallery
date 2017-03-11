<?php
class Token
{
    public static function generate()
    {
        return Session::put(Config::get('session/token_name'),md5(random_bytes(8)));
    }

    public static function check($token)
    {
        $tokenName = Config::get('session/token_name');

        if(Session::exists($tokenName) && Session::get($tokenName) === $token){
            return true;
        }
        return false;
    }
}