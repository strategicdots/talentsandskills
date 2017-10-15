<?php require_once('initialize.php');

class School extends DatabaseObject {
    protected static $table_name="schools";
    public $id;
    public $user_id;
    public $course;
    public $degree;
    public $school;
    public $location;
    public $grade;
    public $year;



    public function create() {
        global $database;

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "user_id, course, degree, school, location, grade, year ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->user_id) . "', '";
        $sql_query .= $database->escape_value($this->course) . "', '";
        $sql_query .= $database->escape_value($this->degree) . "', '";
        $sql_query .= $database->escape_value($this->school) . "', '";
        $sql_query .= $database->escape_value($this->location) . "', '";
        $sql_query .= $database->escape_value($this->grade) . "', '";
        $sql_query .= $database->escape_value($this->year) . "')";

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
        $sql .= "course='" . $database->escapeValue($this->course) . "', ";
        $sql .= "degree='" . $database->escapeValue($this->degree) . "', ";
        $sql .= "school='" . $database->escapeValue($this->school) . "', ";
        $sql .= "location='" . $database->escapeValue($this->location) . "', ";
        $sql .= "grade='" . $database->escapeValue($this->grade) . "', ";
        $sql .= "year='" . $database->escapeValue($this->year) . "' ";
        $sql .= "WHERE user_id=" . $database->escapeValue($this->user_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }




}