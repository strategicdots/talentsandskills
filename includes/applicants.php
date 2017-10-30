<?php require_once('initialize.php');

class Applicants extends DatabaseObject {
    protected static $table_name="applicants";
    public $id;
    public $user_id;
    public $job_id;
    public $motivation_letter;


    public function create() {
      global $database;

      $sql = "INSERT INTO " . self::$table_name . " ( ";
      $sql .= "user_id, job_id, motivation_letter ";
      $sql .= ") VALUES ('";
      $sql .= $database->escapeValue($this->user_id) . "', '";
      $sql .= $database->escapeValue($this->job_id) . "', '";
      $sql .= $database->escapeValue($this->motivation_letter) . "' )";

      if($database->query($sql)) {
          $this->id = $database->insertID();
          return true;
      } else {
          return false;
      }
  }
}


