<?php
class User
{
    private $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function register($values = array())
    {
        if($this->db->insert('users',$values)){
            return true;
        }
        return false;
    }
}