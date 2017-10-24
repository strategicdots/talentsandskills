<?php require_once('initialize.php');

class FileUpload extends DatabaseObject {
    // protected static $table_name="images";
    public $filename;
    public $type;
    public $size;

    public $errors = [];
    protected $temp_path;

    protected $upload_errors  = [
        UPLOAD_ERR_OK 	      => "No errors.",
        UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL 	=> "Partial upload.",
        UPLOAD_ERR_NO_FILE 	=> "No file uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
    ];

    public function targetPath() {
        return filePath(static::$parentDir, $this->filename);
    } 
    public function attach_file($file) {

        if(!$file || empty($file) || !is_array($file)) {
            // CASE 1: nothing uploaded or wrong argument usage
            $this->errors[] = "No file was uploaded.";
            return false;

        } elseif($file['error'] != 0) {
            // CASE 2: image upload error
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            // CASE 3: upload success
            $this->temp_path  = $file['tmp_name'];
            $this->filename   = str_replace(" ", "-", basename($file['name']));
            $this->type       = $file['type'];
            $this->size       = $file['size'];
            return true;

        }
    }   
    
}