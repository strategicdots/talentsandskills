<?php require_once('initialize.php');

class Jobs extends DatabaseObject {
    protected static $table_name="jobs";

    public $id;
    public $employer_id;
    public $title;
    public $job_field;
    public $job_type;
    public $location;
    public $salary_range;
    public $deadline;
    public $keywords;
    public $job_experience;
    public $description;
    public $qualification;
    public $appicants;    

    public function create() {
        global $database;

        $sql  = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "employer_id, title, job_field, job_type, location, salary_range, deadline, ";
        $sql .= "keywords, job_experience, description, qualification ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->employer_id) . "', '";
        $sql .= $database->escapeValue($this->title) . "', '";
        $sql .= $database->escapeValue($this->job_field) . "', '";
        $sql .= $database->escapeValue($this->job_type) . "', '";
        $sql .= $database->escapeValue($this->location) . "', '";
        $sql .= $database->escapeValue($this->salary_range) . "', '";
        $sql .= $database->escapeValue($this->deadline) . "', '";
        $sql .= $database->escapeValue($this->keywords) . "', '";
        $sql .= $database->escapeValue($this->job_experience) . "', '";
        $sql .= $database->escapeValue($this->description) . "', '";
        $sql .= $database->escapeValue($this->qualification) . "')";

        // echo $sql; exit;
        if($database->query($sql)) {
            $this->id = $database->insertID();
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        global $database;

        $sql  = "DELETE from " . self::$table_name;
        $sql .= " WHERE id = " . $database->escapeValue($this->id);
        $sql .= " LIMIT 1";

        if($database->query($sql)) {
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

    public static function newJobs() {
        $sql = "SELECT * FROM " . self::$table_name . " ORDER BY id DESC LIMIT 5 ";

        $jobObjects = self::findBySQLQuery($sql);

        if($jobObjects) { 
            return $jobObjects; 
        } else {
            return false;
        }

    }




}