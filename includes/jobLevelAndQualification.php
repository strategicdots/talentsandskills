<?php require_once('initialize.php');

class JobLevel extends DatabaseObject {
    protected static $table_name="job_level";
    public $id;
    public $level;
}

class JobMinimumQualification extends DatabaseObject {
    protected static $table_name="job_minimum_qualification";
    public $id;
    public $qualification;
}

$jobLevel = JobLevel::findAll();
$jobQualification = JobMinimumQualification::findAll();