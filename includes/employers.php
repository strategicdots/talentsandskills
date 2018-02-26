<?php require_once('initialize.php');

class Employer extends User {
    protected static $table_name="users";

    public $about_company;
    public $job_field;
    public $subscription;
    
    public function create() {
        global $database;
        $hashedPassword = passwordEncrypt($this->password);

        $sql  = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "company_name, job_field, phone, email, employer, password ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->company_name) . "', '";
        $sql .= $database->escapeValue($this->job_field) . "', '";
        $sql .= $database->escapeValue($this->phone) . "', '";
        $sql .= $database->escapeValue($this->email) . "', '";
        $sql .= $database->escapeValue($this->employer) . "', '";
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
        $sql .= "company_name='" . $database->escapeValue($this->company_name) . "', ";
        $sql .= "about_company='" . $database->escapeValue($this->about_company) . "', ";
        $sql .= "job_field='" . $database->escapeValue($this->job_field) . "' ";
        $sql .= "WHERE id=" . $database->escapeValue($this->id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }
}