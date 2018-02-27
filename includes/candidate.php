<?php require_once('initialize.php');

class Candidate extends User {
    protected static $table_name="users";
    public $gender;
    public $dob;
    public $candidate = "1";
    public $personal_statement;
    public $cv_path;

    
    public function create() {
        global $database;
        $hashedPassword = passwordEncrypt($this->password);

        $sql  = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "firstname, lastname, phone, email, candidate, password ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->firstname) . "', '";
        $sql .= $database->escapeValue($this->lastname) . "', '";
        $sql .= $database->escapeValue($this->phone) . "', '";
        $sql .= $database->escapeValue($this->email) . "', '";
        $sql .= $database->escapeValue($this->candidate) . "', '";
        $sql .= $hashedPassword . "')";

        if($database->query($sql)) {
            $this->id = $database->insertID();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;

        $sql  = "UPDATE " . self::$table_name . " SET ";
        $sql .= "email='" . $database->escapeValue($this->email) . "', ";
        $sql .= "phone='" . $database->escapeValue($this->phone) . "', ";
        $sql .= "address='" . $database->escapeValue(nl2br($this->address)) . "', ";
        $sql .= "personal_statement='" . $database->escapeValue(nl2br($this->personal_statement)) . "', ";
        $sql .= "location='" . $database->escapeValue($this->location) . "', ";
        $sql .= "gender='" . $database->escapeValue($this->gender) . "', ";
        $sql .= "dob='" . $database->escapeValue($this->dob) . "' ";
        $sql .= "WHERE id=" . $database->escapeValue($this->id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {            
            return false;
        }
    }

}