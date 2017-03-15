<?php
class File
{
    private $file,
            $uploadDir,
            $allowedTypes = ['image/jpg','image/jpeg','image/png','image/bmp'],
            $allowedSize = 16000000,
            $saveName = "",
            $errors = array();

    private $fileUploadErrors = [
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.'
    ];
    
    public function __construct($fileName)
    {
        $this->file = $_FILES[$fileName];
        $this->uploadDir = Config::get('upload/directory');
    }

    public function check()
    {
        if($this->getErrorCode() !== 0){
            $customError = $this->fileUploadErrors[$this->getErrorCode()];
            $this->addErrors($customError);
        }else if(!in_array($this->getMimeType(),$this->allowedTypes)){
            $this->addErrors("That extension is not allowed");
        }else if($this->getSize() > $this->allowedSize){
            $this->addErrors("Maximum file size is ".$this->allowedSize);
        }
        return $this;
    }

    public function upload()
    {
        if(move_uploaded_file($this->getTmpName(),$this->uploadDir."/".$this->saveName)){
            return true;
        }
        return false;
    }

    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function setSaveName($saveName)
    {
        $this->saveName = $saveName;
    }

    public function setAllowedTypes($allowedTypes)
    {
        if(is_array($allowedTypes)){
            $this->allowedTypes = $allowedTypes;
        }else{
            $this->allowedTypes = [$allowedTypes];
        }
    }

    public function setAllowedSize($allowedSize)
    {
        $this->allowedSize = $allowedSize;
    }

    public function getSaveName()
    {
        return $this->saveName;
    }

    public function getUploadDir()
    {
        return $this->uploadDir;
    }

    private function fileParts()
    {
        return pathinfo($this->file['name']);
    }

    public function getClientOriginalName()
    {
        return $this->fileParts()['filename'];
    }

    public function getClientOriginalExtension()
    {
        return $this->fileParts()['extension'];
    }

    private function getErrorCode()
    {
        return $this->file['error'];
    }

    public function getSize()
    {
        return $this->file['size'];
    }

    public function getTmpName()
    {
        return $this->file['tmp_name'];
    }

    public function getMimeType()
    {
        return mime_content_type($this->getTmpName());
    }

    public function addErrors($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function haveErrors()
    {
        return (!empty($this->errors)) ? true : false;
    }
}