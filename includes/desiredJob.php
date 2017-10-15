<?php require_once('initialize.php');

class DesiredJob extends DatabaseObject {
    protected static $table_name="desired_job";
    public $id;
    public $user_id;
    public $job_title;
    public $job_type;
    public $salary_range;
    public $location;
    public $job_field;



    public function create() {
        global $database;

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "user_id, job_title, availability, salary_range, location, field ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->user_id) . "', '";
        $sql_query .= $database->escape_value($this->job_title) . "', '";
        $sql_query .= $database->escape_value($this->availability) . "', '";
        $sql_query .= $database->escape_value($this->salary_range) . "', '";
        $sql_query .= $database->escape_value($this->location) . "', '";
        $sql_query .= $database->escape_value($this->field) . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;

        $sql  = "UPDATE " . self::$table_name . " SET ";
        $sql .= "job_title='" . $database->escapeValue($this->job_title) . "', ";
        $sql .= "job_type='" . $database->escapeValue($this->job_type) . "', ";
        $sql .= "salary_range='" . $database->escapeValue($this->salary_range) . "', ";
        $sql .= "location='" . $database->escapeValue($this->location) . "', ";
        $sql .= "job_field='" . $database->escapeValue($this->job_field) . "' ";
        $sql .= "WHERE user_id=" . $database->escapeValue($this->user_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }




}