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

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "user_id, job_title, employer, time_span, responsibilities ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->user_id) . "', '";
        $sql_query .= $database->escape_value($this->job_title) . "', '";
        $sql_query .= $database->escape_value($this->employer) . "', '";
        $sql_query .= $database->escape_value($this->time_span) . "', '";
        $sql_query .= $database->escape_value($this->responsibilities) . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

}