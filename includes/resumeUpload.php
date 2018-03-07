<?php require_once('initialize.php');

function cvFormat($type) { 
    if($type == "application/pdf" ||
       $type == "application/msword" ||
       $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||
       $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.template" ||
       $type == "application/vnd.ms-word.document.macroEnabled.12" ||
       $type == "application/vnd.ms-word.template.macroEnabled.12" )    
    { return true; } 

    else { return false; }
}

class Resume extends FileUpload {
    protected static $table_name = "users";
    public static $parentDir = SITE_ROOT.DS."uploads";

    // overwriting upload errors message


   
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
        $sql .= "cv_path='" . $database->escapeValue(urlFromWebRoot($this->targetPath())) . "' ";
        $sql .= "WHERE id=" . $database->escapeValue($user_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
        
    }

}