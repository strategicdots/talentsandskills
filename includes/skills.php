<?php require_once('initialize.php');

class Skills extends DatabaseObject {
    protected static $table_name="skills";
    public $id;
    public $user_id;
    public $skill_name;



    public function create() {
        global $database;

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "user_id, skill_name ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->user_id) . "', '";
        $sql_query .= $database->escape_value($this->skill_name) . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

}