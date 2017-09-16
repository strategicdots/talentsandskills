<?php
require_once('initialize.php');

class DatabaseObject {

    protected static $table_name;

    // Common Database Objects
    public static function findAll() {
        return static::findBySQLQuery("SELECT * FROM " . static::$table_name);
    }

    public static function findAllUnderParent($parent, $child) {
        $sql  = "SELECT * FROM ";
        $sql .= static::$table_name;
        $sql .= " WHERE " . $child . "=" . $parent;

        return static::findBySQLQuery($sql);
    }

    public static function findBySQLQuery($sql="") {
        global $database;

        $resultSet = $database->query($sql);
        $objectArray = [];
        while($row =$database->fetchArray($resultSet)) {
            $objectArray[] = static::instantiate($row);
        }
        if($objectArray) {
            return $objectArray;
        } else {
            return false;
        }
    } 

    public static function instantiate($record) {
        $object = new static;

        foreach($record as $attribute=>$value) {
            if($object->hasAttribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function hasAttribute ($attribute) {
        $object_vars = get_object_vars($this);

        return array_key_exists($attribute, $object_vars);
    }

    protected function attributes() {
        // return an array of attribute keys and their values:
        return get_object_vars($this);
    }

    protected function sanitizedAttributes() {
        global $database;
        $cleanAttributes = [];
        foreach ($this->attributes() as $key => $value) {
            $cleanAttributes[$key] = $database->escapeValue($value);
        }
        return $clean_attributes;
    }

    public static function findDetails($id) {
        global $database;
        $sql = "SELECT * FROM ". static::$table_name . " WHERE id = '{$database->escapeValue($id)}' LIMIT 1";
        $result_array = $database->fetchArray($database->query($sql));
        $object_array = static::instantiate($result_array);
        return $object_array;

    }
}
?>

