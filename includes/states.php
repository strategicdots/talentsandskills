<?php require_once('initialize.php');

class State extends DatabaseObject {
    protected static $table_name="states";
    public $id;
    public $name;

}