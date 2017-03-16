<?php
class Image
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function insertImage($fields = array())
    {
        $insertImage = $this->db->insert('images',$fields);
        
        if($insertImage){
            return true;
        }
        return false;
    }

    public function allImages($userId)
    {
        return $this->db->get('images',['user_id','=',$userId]);
    }
}