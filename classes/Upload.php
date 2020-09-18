<?php
 class Upload{

    protected $uploadDir;
    protected $defaultUploadDir = 'uploads';
    public $file;
    public $fileName;
    public $filePath;
    protected $rootDir;
    protected $errors = [];

    protected function Validate(){
    if(!$this->isSizeAllowd()){
       array_push($this->errors, 'This file is not allowd');
   }elseif(!$this->isMimeAllowed()){
       array_push($this->errors, 'File type is not allowd');
    }
    return $this->errors;

    }




    public function __construct($uploadDir, $rootDir = false)
    {
        if($rootDir){
            $this->rootDir = $rootDir;
        }else{
            $this->rootDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'phpcourses';
        }

        $this->filename = $uploadDir;
        $this->uploadDir = $this->rootDir.'/'.$uploadDir;


    }


    protected function createUploadDir(){
        if (!is_dir($this->uploadDir)){
            umask(0);
            if(!mkdir($this->uploadDir,0777)){
                array_push($this->errors,'Could not create Dir');
                return false;
            }
        }
        return true;
}

public function upload(){

    $this->fileName = time().$this->file['name'];
    $this->filePath .= '/'.$this->fileName;

    if($this->validate()){
        return $this->errors;
    }elseif(!$this->createUploadDir()){
        return $this->errors;
    }elseif(!move_uploaded_file($this->file['tmp_name'], $this->uploadDir.'/'.$this->fileName)){
        
        array_push($this->errors, 'Error uploading your file');
    }
// التعديل هنا لتحسين سلسلة الشروط + ارجاع مصفوفة الأخطاء في حال عدم وجود أخطاء لكي يمكن استخدامها والتأكد منها في الملفات الأخرى
    return $this->errors;
}

    protected function isMimeAllowed(){
          $allowd = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];
          $fileMimeType = mime_content_type($this->file['tmp_name']);
           if(!in_array($fileMimeType, $allowd)){
        return false;
    }
           return  true;
}



protected function isSizeAllowd()
{
    $maxFileSIZE = 100 * 1024 * 1024;
    $fileSize = $this->file['size'];
    if($fileSize > $maxFileSIZE ){
        return false;
    }
    return true;

}

}