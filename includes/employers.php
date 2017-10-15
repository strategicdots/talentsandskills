<?php require_once('initialize.php');

class Employer extends DatabaseObject {
    protected static $table_name="employers";
    public $id;
    public $name;
    public $phone;
    public $email;
    public $job_field;
    public $avatar_url;
    public $password;

    public function create() {
        global $database;
        $hashed_password = password_hash($this->password);

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "name, phone, email, job_field, password ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->name) . "', '";
        $sql_query .= $database->escape_value($this->phone) . "', '";
        $sql_query .= $database->escape_value($this->email) . "', '";
        $sql_query .= $database->escape_value($this->job_field) . "', '";
        $sql_query .= $hashed_password . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;

        $sql  = "UPDATE users SET ";
        $sql .= "email='" . $database->escapeValue($this->email) . "', ";
        $sql .= "phone='" . $database->escapeValue($this->phone) . "', ";
        $sql .= "company_name='" . $database->escapeValue($this->name) . "', ";
        $sql .= "job_field='" . $database->escapeValue($this->job_field) . "', ";
        $sql .= "WHERE id=" . $database->escapeValue($this->id);

        if($database->query($sql) && ($database->affectedRows() == 1)) {
            return true;
        } else {
            return false;
        }
    }

    public static function findDetailsByEmail($email) {
        global $database;

        $sql = "SELECT * FROM users WHERE email = '{$database->escapeValue($email)}' LIMIT 1";

        $result_array = $database->fetchArray($database->query($sql));

        $object_array = self::instantiate($result_array);

        if($object_array) {
            return $object_array;
        } else {
            return null;
        }

    }


}