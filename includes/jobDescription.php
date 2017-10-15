<?php require_once('initialize.php');

class JobDescription extends DatabaseObject {
    protected static $table_name="job_description";
    public $id;
    public $job_id;
    public $brief_desc;
    public $other_info;
    public $qualification;
    public $experience;
    public $keywords;



    public function create() {
        global $database;

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "job_id, brief_desc, other_info, qualification, experience, keywords ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->job_id) . "', '";
        $sql_query .= $database->escape_value($this->brief_desc) . "', '";
        $sql_query .= $database->escape_value($this->other_info) . "', '";
        $sql_query .= $database->escape_value($this->qualification) . "', '";
        $sql_query .= $database->escape_value($this->experience) . "', '";
        $sql_query .= $database->escape_value($this->keywords) . "')";

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
        $sql .= "brief_desc='" . $database->escapeValue($this->brief_desc) . "', ";
        $sql .= "other_info='" . $database->escapeValue($this->other_info) . "', ";
        $sql .= "qualification='" . $database->escapeValue($this->qualification) . "', ";
        $sql .= "experience='" . $database->escapeValue($this->experience) . "', ";
        $sql .= "keywords='" . $database->escapeValue($this->keywords) . "' ";
        $sql .= "WHERE $job_id=" . $database->escapeValue($this->$job_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }


}