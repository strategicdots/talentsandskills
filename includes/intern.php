<?php require_once('initialize.php');

class Intern extends User {
    protected static $table_name="users";
    public $gender;
    public $dob;
    public $intern = "1";
    public $cv_path;


    public function create() {
        global $database;
        $hashedPassword = passwordEncrypt($this->password);

        $sql  = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "firstname, lastname, phone, intern, email, candidate, password ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->firstname) . "', '";
        $sql .= $database->escapeValue($this->lastname) . "', '";
        $sql .= $database->escapeValue($this->phone) . "', '";
        $sql .= $database->escapeValue($this->intern) . "', '";
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

}