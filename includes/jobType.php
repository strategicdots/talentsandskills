<?php require_once('initialize.php');

class JobType extends DatabaseObject {
    protected static $table_name="job_type";
    public $id;
    public $type;

}