<?php require_once('initialize.php');

class EmploymentHistory extends DatabaseObject {
    protected static $table_name="employment_history";
    public $id;
    public $user_id;
    public $job_title;
    public $employer;
    public $time_span;
    public $responsibilities;



    public function create() {
        global $database;

        $sql  = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "user_id, job_title, employer, time_span, responsibilities ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->user_id) . "', '";
        $sql .= $database->escapeValue($this->job_title) . "', '";
        $sql .= $database->escapeValue($this->employer) . "', '";
        $sql .= $database->escapeValue($this->time_span) . "', '";
        $sql .= $database->escapeValue($this->responsibilities) . "')";

        if($database->query($sql)) {
            $this->id = $database->insertID();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;

        $sql  = "UPDATE " . self::$table_name . "SET ";
        $sql .= "job_title='" . $database->escapeValue($this->job_title) . "', ";
        $sql .= "employer='" . $database->escapeValue($this->employer) . "', ";
        $sql .= "time_span='" . $database->escapeValue($this->time_span) . "', ";
        $sql .= "responsibilities='" . $database->escapeValue($this->responsibilities) . "' ";
        $sql .= "WHERE user_id=" . $database->escapeValue($this->user_id);

        return ($database->query($sql)) ? true : false;
        
    }

}