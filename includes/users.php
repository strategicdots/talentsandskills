<?php require_once('initialize.php');

class User extends DatabaseObject {
    protected static $table_name="users";
    public $id;
    public $identifier;
    public $firstname;
    public $lastname;
    public $gender;
    public $phone;
    public $email;
    public $address;
    public $location;
    public $dob;
    public $avatar_url;
    public $employer;
    public $candidate;
    public $personal_statement;
    public $password;
    public $cv_path;
    
    public function fullName() {
        if(isset($this->firstname) && isset($this->lastname)) {
            return $this->firstname . " " . $this->lastname;
        } else {
            return "";
        }
    }

    public function create() {
        global $database;
        $hashed_password = password_encrypt($this->password);

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "firstname, lastname, gender, phone, email, address, location, dob, employer, personal_statement, password ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->firstname) . "', '";
        $sql_query .= $database->escape_value($this->lastname) . "', '";
        $sql_query .= $database->escape_value($this->gender) . "', '";
        $sql_query .= $database->escape_value($this->phone) . "', '";
        $sql_query .= $database->escape_value($this->email) . "', '";
        $sql_query .= $database->escape_value($this->address) . "', '";
        $sql_query .= $database->escape_value($this->location) . "', '";
        $sql_query .= $database->escape_value($this->dob) . "', '";
        $sql_query .= $database->escape_value($this->employer) . "', '";
        $sql_query .= $database->escape_value($this->personal_statement) . "', '";
        $sql_query .= $hashed_password . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function testCreate() {
        global $database;
        $hashed_password = password_encrypt($this->password);

        $sql  = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "firstname, lastname, phone, email, candidate, password ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->firstname) . "', '";
        $sql .= $database->escapeValue($this->lastname) . "', '";
        $sql .= $database->escapeValue($this->phone) . "', '";
        $sql .= $database->escapeValue($this->email) . "', '";
        $sql .= $database->escapeValue($this->candidate) . "', '";
        $sql .= $hashed_password . "')";

        if($database->query($sql)) {
            $this->id = $database->insertID();
            return true;
        } else {
            return false;
        }
    }


    public function update() {
        global $database;

        $sql  = "UPDATE users SET ";
        $sql .= "email='" . $database->escapeValue($this->email) . "', ";
        $sql .= "phone='" . $database->escapeValue($this->phone) . "', ";
        $sql .= "employer='" . $database->escapeValue($this->employer) . "', ";
        $sql .= "address='" . $database->escapeValue(nl2br($this->address)) . "', ";
        $sql .= "personal_statement='" . $database->escapeValue(nl2br($this->personal_statement)) . "', ";
        $sql .= "location='" . $database->escapeValue($this->location) . "', ";
        $sql .= "dob='" . $database->escapeValue($this->dob) . "' ";
        $sql .= "WHERE id=" . $database->escapeValue($this->id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }

    public static function findDetails($id) {
        global $database;


        $sql = "SELECT * FROM users WHERE ";
        $sql .= "id = '{$database->escapeValue($id)}' ";
        $sql .= " LIMIT 1";

        $result_array = $database->fetchArray($database->query($sql));

        $object_array = self::instantiate($result_array);

        if($object_array) {
            return $object_array;
        } else {
            return null;
        }
    }

    public static function findDetailsByEmail($email) {
        global $database;

        $sql  = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE email = '{$database->escapeValue($email)}' ";
        $sql .= " LIMIT 1";

        $result_array = $database->fetchArray($database->query($sql));

        $object_array = self::instantiate($result_array);

        if($object_array) {
            return $object_array;
        } else {
            return null;
        }

    }


}