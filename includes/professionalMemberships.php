<?php require_once('initialize.php');

class Membership extends DatabaseObject {
    protected static $table_name="professional_memberships";
    public $id;
    public $user_id;
    public $year;
    public $organization;



    public function create() {
        global $database;

        $sql  = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "user_id, year, organization ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->user_id) . "', '";
        $sql .= $database->escapeValue($this->year) . "', '";
        $sql .= $database->escapeValue($this->organization) . "')";

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
        $sql .= "organization = '" . $database->escapeValue($this->organization) ."', ";
        $sql .= "year = '" . $database->escapeValue($this->year) . "' ";
        $sql .= " WHERE user_id=" . $database->escapeValue($this->user_id);
        $sql .= " AND id =" . $database->escapeValue($this->id);
        $sql .= " LIMIT 1";

        if($database->query($sql)) { return true; } else { return false; }
    }

}