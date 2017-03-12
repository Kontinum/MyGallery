<?php
class User
{
    private $db = null,
            $userData,
            $isLoggedIn = false,
            $sessionName;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->sessionName = Config::get('session/session_name');
    }

    public function register($values = array())
    {
        if($this->db->insert('users',$values)){
            return true;
        }
        return false;
    }

    public function found($user)
    {
        $field = (is_numeric($user)) ? 'id' : 'username';

        $userCheck = $this->db->get('users',[$field,'=',$user]);

        if($userCheck->count()){
            $this->userData = $userCheck->first();
            return true;
        }
        return false;
    }

    public function login($username,$password)
    {
        $user = $this->found($username);

        if($user){
            if(Hash::make($password,$this->userData->salt) === $this->userData->password){
                Session::put($this->sessionName,$this->userData->id);
                $this->isLoggedIn = true;
                return true;
            }
        }
        return false;
    }

    public function isLoggedIn()
    {
        return $this->isLoggedIn;
    }

    public function userData()
    {
        return $this->userData;
    }
}