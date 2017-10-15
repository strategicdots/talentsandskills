<?php require_once('initialize.php');

class JobLevel extends DatabaseObject {
    protected static $table_name="job_level";
    public $id;
    public $level;
}