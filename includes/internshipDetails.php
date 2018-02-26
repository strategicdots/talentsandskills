<?php require_once('initialize.php');

class InternshipDetails extends DatabaseObject {
    protected static $table_name="internship_details";
    public $id;
    public $intern_id;
    public $duration;
    public $course;
    public $start_date;
    public $state;
    public $school;


    public function create() {
        global $database;

        $sql = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "intern_id, duration, course, start_date, state, school ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->intern_id) . "', '";
        $sql .= $database->escapeValue($this->duration) . "', '";
        $sql .= $database->escapeValue($this->course) . "', '";
        $sql .= $database->escapeValue($this->start_date) . "', '";
        $sql .= $database->escapeValue($this->state) . "', '";
        $sql .= $database->escapeValue($this->school) . "')";

        if($database->query($sql)) {
            $this->id = $database->insertID();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;

        $sql  = "UPDATE " . self::$table_name . " SET ";
        $sql .= "duration='" . $database->escapeValue($this->duration) . "', ";
        $sql .= "course='" . $database->escapeValue($this->course) . "', ";
        $sql .= "start_date='" . $database->escapeValue($this->start_date) . "', ";
        $sql .= "state='" . $database->escapeValue($this->state) . "', ";
        $sql .= "school='" . $database->escapeValue($this->school) . "' ";
        $sql .= "WHERE intern_id=" . $database->escapeValue($this->intern_id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }

    public static function findByInternID($id) {
        global $database;

        $sql  = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE intern_id=";
        $sql .= $database->escapeValue($id);
        $sql .= " LIMIT 1";

        $output = self::findBySQLQuery($sql);
        
        if(!$output) {
            
            return false;
        }
        
        return $output;
    }

    public static function delete($id) {
        global $database;

        $sql  = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE id = " . $database->escapeValue($id);
        $sql .= " LIMIT 1";

        return $database->query($sql) ? true : false;
    }
}

class Internships extends DatabaseObject {
    protected static $table_name = "internships";
    public $id;
    public $details_id;
    public $employer_id;

}