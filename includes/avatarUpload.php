<?php require_once('initialize.php');

function imgFormat($type) { 
      if($type == "image/jpeg" || $type == "image/png")  { 
          return true; 
      } else { return false; }
}

class Avatar extends FileUpload {
    protected static $table_name = "users";
    public static $parentDir = SITE_ROOT.DS."uploads/avatar";

   
    public function upload() {
        if(!empty($this->errors)) { exit; return false; }

        if(empty($this->filename) || empty($this->temp_path)) {
             
             $this->errors[] = "Avatar location was not available.";
                return false;
            }

        if(!imgFormat($this->type)) {
            
                $this->errors[]  = "The file uploaded is not in the right format. <br>"; 
                $this->errors[] .= "Please upload either .png, or .jpg format";
                return false;
            }

        // check if file exists
        if(file_exists($this->targetPath())) {
             
            $this->errors[] = "please, rename this file and resend.";
                return false;
        }

        if(move_uploaded_file($this->temp_path, $this->targetPath())) {
             
                if(!empty($this->temp_path)) {
                    unset($this->temp_path);
                }
                return true;
            
        } else {    
              // File was not moved.
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
                return false;
            }
    }
    
    public function updateDB($user_id) {
        global $database;

        $sql  = "UPDATE " . self::$table_name . " SET ";
        $sql .= "avatar_url='" . $database->escapeValue(urlFromWebRoot($this->targetPath())) . "' ";
        $sql .= "WHERE id=" . $database->escapeValue($user_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
        
    }

}