<?php
session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host' => '127.0.0.1',
        'db_name' => 'mygallery',
        'username' => 'root',
        'password' =>''
    ],
    'session' => [
        'session_name' => 'user',
        'token_name' => 'token'
    ],
    'remember' => [
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ],
    'upload' => [
        'directory' => $_SERVER['DOCUMENT_ROOT'].'/storage'
    ]
];


spl_autoload_register(function($className){
   require_once "classes/".$className.".php";
});

require_once "functions/sanitize.php";

$cookieName = Config::get('remember/cookie_name');
$sessionName = Config::get('session/session_name');

if(Cookie::exists($cookieName) && !Session::exists($sessionName)){
    $cookieHash = Cookie::get($cookieName);

    $hashCheck = Database::getInstance()->get('remember_users',['hash','=',$cookieHash]);

    if($hashCheck->count()){
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }

}