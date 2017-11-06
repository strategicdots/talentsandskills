<?php require_once('initialize.php');

class User extends DatabaseObject {
    protected static $table_name="users";
    public $id;
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

}