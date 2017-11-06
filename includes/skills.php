<?php require_once('initialize.php');

class Skills extends DatabaseObject {
    protected static $table_name="skills";
    public $id;
    public $user_id;
    public $skill_name;



    public function create() {
        global $database;

        $sql = "INSERT INTO " . self::$table_name . " ( ";
        $sql .= "user_id, skill_name ";
        $sql .= ") VALUES ('";
        $sql .= $database->escapeValue($this->user_id) . "', '";
        $sql .= $database->escapeValue($this->skill_name) . "')";

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
        $sql .= "skill_name = '" . $database->escapeValue($this->skill_name);
        $sql .= "' WHERE user_id ='" . $database->escapeValue($this->user_id) . "' ";
        $sql .= " AND id=" . $database->escapeValue($this->id);
        $sql .= " LIMIT 1";

        if($database->query($sql)) {return true; } else { return false; }


    }

}