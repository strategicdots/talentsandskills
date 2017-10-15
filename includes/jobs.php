<?php require_once('initialize.php');

class Jobs extends DatabaseObject {
    protected static $table_name="jobs";

    public $id;
    public $employer_id;
    public $employer;
    public $keywords;
    public $title;
    public $job_field;
    public $job_experience;
    public $job_level;
    public $job_type;
    public $location;
    public $salary_range;
    public $deadline;

    public function create() {
        global $database;

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "employer_id, title, job_field, job_type, location, salary_range, deadline ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->employer_id) . "', '";
        $sql_query .= $database->escape_value($this->title) . "', '";
        $sql_query .= $database->escape_value($this->job_field) . "', '";
        $sql_query .= $database->escape_value($this->job_type) . "', '";
        $sql_query .= $database->escape_value($this->location) . "', '";
        $sql_query .= $database->escape_value($this->salary_range) . "', '";
        $sql_query .= $database->escape_value($this->deadline) . "')";

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
        $sql .= "title='" . $database->escapeValue($this->title) . "', ";
        $sql .= "job_field='" . $database->escapeValue($this->job_field) . "', ";
        $sql .= "job_type='" . $database->escapeValue($this->job_type) . "', ";
        $sql .= "location='" . $database->escapeValue($this->location) . "', ";
        $sql .= "salary_range='" . $database->escapeValue($this->salary_range) . "', ";
        $sql .= "deadline='" . $database->escapeValue($this->deadline) . "' ";
        $sql .= "WHERE employer_id=" . $database->escapeValue($this->employer_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }

    public static function topSearch($keyword, $location) {
        global $database;

        $sql  = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE ( CONCAT_WS('|', keywords, employer, location) LIKE '%";
        $sql .= $database->escapeValue($keyword);
        $sql .= "%' ) AND ";
        $sql .= "location = '";
        $sql .= $database->escapeValue($location) . "'";

        $jobObjects = self::findBySQLQuery($sql);

        if($jobObjects) { 
            return $jobObjects; 
        } else {
            return false;
        }

    }

    public static function jobFilter($array) {
        global $database;
        $i=0;

        $sql  = "SELECT * FROM " . self::$table_name;
        foreach($array as $key => $value) {
            if($i<=0) { $sql .= " WHERE "; } else { $sql .= "AND "; }
            $sql .= $database->escapeValue($key);
            $sql .= "='" . $database->escapeValue($value) . "' ";
            $i++;
        }
        
        $jobObjects = self::findBySQLQuery($sql);

        if($jobObjects) { 
            return $jobObjects; 
        } else {
            return false;
        }

    }




}