<?php require_once('initialize.php');

class Membership extends DatabaseObject {
    protected static $table_name="professional_memberships";
    public $id;
    public $user_id;
    public $year;
    public $organization;



    public function create() {
        global $database;

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "user_id, year, organization ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->user_id) . "', '";
        $sql_query .= $database->escape_value($this->year) . "', '";
        $sql_query .= $database->escape_value($this->organization) . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

}