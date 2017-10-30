<?php require_once('initialize.php');

class Resume extends FileUpload {
    protected static $table_name = "users";
    public static $parentDir = "../../uploads";

   
    public function upload() {
        if(!empty($this->errors)) { exit; return false; }

        if(empty($this->filename) || empty($this->temp_path)) {
             
             $this->errors[] = "The file location was not available.";
                return false;
            }

        if(!cvFormat($this->type)) {
            
                $this->errors[]  = "The file uploaded is not in the right format. <br>"; 
                $this->errors[] .= "Please make sure the document is in .pdf, .doc or .docx";
                return false;
            }
            
        // check if file exists
        if(file_exists($this->targetPath())) {
             
            $this->errors[] = "please, rename this file and resend.";
                return false;
        }

        if(move_uploaded_file($this->temp_path, $this->targetPath())) {
             
                unset($this->temp_path);
                return true;
            
        } else {                
             
              // File was not moved.
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
                return false;
            }
    }

    public function destroy() {
        // First remove the database entry
        if($this->delete()) {
            // then remove the file
            // Note that even though the database entry is gone, this object 
            // is still around (which lets us use $this->image_path()).
            $target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
            return unlink($target_path) ? true : false;
        } else {
            // database delete failed
            return false;
        }
    }

    public function updateDB($user_id) {
        global $database;

        $sql  = "UPDATE " . self::$table_name . " SET ";
        $sql .= "cv_path='" . $database->escapeValue($this->targetPath()) . "' ";
        $sql .= "WHERE id=" . $database->escapeValue($user_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
        
    }

}