<?php require_once('initialize.php');

class SalaryRange extends DatabaseObject {
    protected static $table_name="salary_range";
    public $id;
    public $salary_range;

}

$salaryRange = SalaryRange::findAll();