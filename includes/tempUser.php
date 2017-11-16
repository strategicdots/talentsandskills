<?php require_once('initialize.php');

class TemporaryUser extends User {
    protected static $table_name="temporary_user";
    public $firstname;
    public $surname;
    public $email;
    public $address;
    public $dob;
    public $merchant;
    public $id;
    public $selector;
    public $validator;
    public $expires;
    public $phone_number;
    public $id_unique;

    public function create() {
        global $database;

        $sql_query = "INSERT INTO user_temp_db ( ";
        $sql_query .= "firstname, surname, id_unique, email, address, dob, merchant, phone_number ";
        $sql_query .= ") VALUES ('";
        $sql_query .= $database->escape_value($this->firstname) . "', '";
        $sql_query .= $database->escape_value($this->surname) . "', '";
        $sql_query .= $database->escape_value($this->id_unique) . "', '";
        $sql_query .= $database->escape_value($this->email) . "', '";
        $sql_query .= $database->escape_value($this->address) . "', '";
        $sql_query .= $database->escape_value($this->dob) . "', '";
        $sql_query .= $database->escape_value($this->merchant) . "', '";
        $sql_query .= $database->escape_value($this->phone_number) . "')";

        if($database->query($sql_query)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function full_name() {
        if(isset($this->firstname) && isset($this->surname)) {
            return $this->firstname . " " . $this->surname;
        } else {
            return $this->firstname;
        }
    }

    public static function set_validator($selector, $validator, $id) {
        global $database;

        $expires_unix       = time() + (60 * 60); // current time plus 1 hour
        $expires            = strftime("%Y-%m-%d %H:%M:%S", $expires_unix);

        $sql  = "UPDATE user_temp_db SET ";
        $sql .= "selector='" . $database->escape_value($selector) . "', ";
        $sql .= "validator='" . $database->escape_value(hash('SHA512', $validator)) . "', ";
        $sql .= "expires='" . $database->escape_value($expires) . "' ";
        $sql .= "WHERE id=" . $database->escape_value($id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;


    }

    public static function find_details($selector) {
        global $database;
        $sql  = "SELECT * FROM user_temp_db"; 
        $sql .= " WHERE selector = '{$database->escape_value($selector)}' LIMIT 1";
        $result_array = $database->fetch_array($database->query($sql));

        return $result_array;

    }

}

?>
