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
        $sql_query .= $hashedPassword . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function testCreate() {
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

        $sql  = "UPDATE users SET ";
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