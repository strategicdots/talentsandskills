<?php require_once('initialize.php');

class JobFields extends DatabaseObject {
    protected static $table_name="job_fields";
    public $id;
    public $name;

    public function create() {
        global $database;

        $sql = "INSERT INTO " . self::$table_name . " (name) VALUES ('";
        $sql .= $database->escapeValue($this->name) . "')";

        if ($database->query($sql)) {
            $this->id = $database->insertID();
            return true;
        } else {
            return false;
        }
    }

}

$jobFields = JobFields::findAll();