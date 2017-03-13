<?php
class User
{
    private $db = null,
            $userData,
            $isLoggedIn = false,
            $sessionName,
            $cookieName;

    public function __construct($user = null)
    {
        $this->db = Database::getInstance();
        $this->sessionName = Config::get('session/session_name');
        $this->cookieName = Config::get('remember/cookie_name');

        if(!$user){
            if(Session::exists($this->sessionName)){
                $user = Session::get($this->sessionName);

                if($this->found($user)){
                    $this->isLoggedIn = true;
                }
            }
        }else{
            $this->found($user);
        }
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

    public function login($username = null,$password = null,$remember = false)
    {
        if(!$username && !$password && $this->dataExists()){
            Session::put($this->sessionName,$this->userData()->id);
        }else {
            $user = $this->found($username);

            if ($user) {
                if (Hash::make($password, $this->userData->salt) === $this->userData->password) {
                    Session::put($this->sessionName, $this->userData->id);
                    $this->isLoggedIn = true;

                    if ($remember) {
                        $hash = Hash::unique();

                        $hashCheck = $this->db->get('remember_users', ['user_id', '=', $this->userData()->id]);
                        if (!$hashCheck->count()) {
                            $this->db->insert('remember_users', [
                                'user_id' => $this->userData()->id,
                                'hash' => $hash
                            ]);
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }

                        Cookie::put($this->cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }

                    return true;
                }
            }
        }
        return false;
    }

    public function logout()
    {
        Session::delete($this->sessionName);
        $this->isLoggedIn = false;
    }

    public function isLoggedIn()
    {
        return $this->isLoggedIn;
    }

    public function userData()
    {
        return $this->userData;
    }

    public function dataExists()
    {
        return (!empty($this->userData)) ? true : false;
    }
}