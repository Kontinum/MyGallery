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

    public function delete($imageId)
    {
        $imageDelete = $this->db->delete('images',['id','=',$imageId]);

        if($imageDelete){
            return true;
        }
        return false;
    }

    public function update($data = array(),$id)
    {
        $imageUpdate = $this->db->update('images',$id,$data);

        if($imageUpdate){
            return true;
        }
        return false;
    }
}