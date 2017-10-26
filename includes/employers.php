<?php require_once('initialize.php');

class Employer extends DatabaseObject {
    protected static $table_name="users";
    public $id;
    public $company_name;
    public $about_company;
    public $firstname;
    public $lastname;
    public $phone;
    public $email;
    public $job_field;
    public $avatar_url;
    public $password;

    public function create() {
        global $database;
        $hashedPassword = password_encrypt($this->password);

        $sql_query = "INSERT INTO " . self::$table_name . " ( ";
        $sql_query .= "company_name, about_company, firstname, lastname, phone, email, job_field, password ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escapeValue($this->company_name) . "', '";
        $sql_query .= $database->escapeValue($this->about_company) . "', '";
        $sql_query .= $database->escapeValue($this->firstname) . "', '";
        $sql_query .= $database->escapeValue($this->lastname) . "', '";
        $sql_query .= $database->escapeValue($this->phone) . "', '";
        $sql_query .= $database->escapeValue($this->email) . "', '";
        $sql_query .= $database->escapeValue($this->job_field) . "', '";
        $sql_query .= $hashedPassword . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insertID();
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
        $sql .= "company_name='" . $database->escapeValue($this->company_name) . "', ";
        $sql .= "about_company='" . $database->escapeValue($this->about_company) . "', ";
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