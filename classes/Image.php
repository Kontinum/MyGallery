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

    public function imageByID($imageId)
    {
        return $this->db->get('images',['id','=',$imageId]);
    }

    public function getImgType($imgPath)
    {
        $imgType = (exif_imagetype($imgPath) == IMAGETYPE_JPEG) ? 'jpg' : 'png';

        return $imgType;
    }
}