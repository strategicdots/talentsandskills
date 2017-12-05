<?php require_once('initialize.php');

class User extends DatabaseObject {
    protected static $table_name="users";
    public $id;
    public $unique_id;
    public $identifier;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $location;
    public $avatar_url;
    public $candidate;
    public $employer;
    public $validated;
    
    public function fullName() {
        if(isset($this->firstname) && isset($this->lastname)) {
            return $this->firstname . " " . $this->lastname;
        } else {
            return "";
        }
    }

    public function isUnique($value, $column) {
        global $database;
        
        $sql  = "SELECT COUNT(*) as count FROM " . self::$table_name . " WHERE "; 
        $sql .= " {$database->escapeValue($column)} = '"; 
        $sql .= $database->escapeValue($value) . "'";

        $result = $database->fetchArray($database->query($sql));
        $count = $result['count'];
        
        if($count <= 0) { return true; } else { return false; }
            
    }

    public static function findDetailsByEmail($email) {
        
        global $database;

        $sql  = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE email = '{$database->escapeValue($email)}' ";
        $sql .= " LIMIT 1";

        $result = $database->fetchArray($database->query($sql));

        $object = self::instantiate($result);

        if($object) {
            return $object;
        } else {
            return null;
        }

    }

    public static function findDetailsByUniqueID($unique_id) {
        
        global $database;
                
        $sql  = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE unique_id = '{$database->escapeValue($unique_id)}' ";
        $sql .= " LIMIT 1";
                
        return (self::findBySQLQuery($sql));
            
    }

    public static function generateUniqueID() {
        global $database;
        
        $sql  = "SELECT (FLOOR(RAND() * 9000000) +1000000) AS random_num ";
        $sql .= " FROM " . self::$table_name;
        $sql .= " WHERE 'random_num' NOT IN (SELECT unique_id FROM " . $self::$table_name. ") ";
        $sql .= " LIMIT 1";
        
        $result = $database->fetchArray($database->query($sql));
        
        if(!empty($result)) {
            return $result['random_num'];
        } else {
            return null;
        }
    }

    public function validateUser($id) {
        global $database;

        $sql  = "UPDATE " . self::$table_name . " SET ";
        $sql .= "validated='1' WHERE id = ";
        $sql .= $database->escapeValue($id);

        $database->query($sql);
        
        if($database->affectedRows == 1) {
            
            return true;
        
        }else {
                
            return false;
        
        }
    }

    public static function resetPassword($password, $user_id) {
        global $database;
        $hashedPassword = passwordEncrypt($password);  
        
        $sql  = "UPDATE ". self::$table_name ." SET password = '";
        $sql .= $hashedPassword . "' WHERE id = '";
        $sql .= $database->escapeValue($user_id) . "' LIMIT 1";

        $database->query($sql) ? true : false;
    }


}