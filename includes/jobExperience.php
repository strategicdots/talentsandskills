<?php require_once('initialize.php');

class JobExperience extends DatabaseObject {
    protected static $table_name="job_experience";
    public $id;
    public $years;
}