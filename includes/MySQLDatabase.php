<?php require_once('initialize.php');

class MySQLDatabase {

    private $conn;

    function __construct() {
        $this->openConn();
    }

    public function openConn() {
        global $config;
        $configLocal = $config['localDB'];
        $configLive = $config['liveDB'];

        $this->conn = mysqli_connect(
            
            $configLocal['server'],
            $configLocal['user'],
            $configLocal['password'],
            $configLocal['db'] 

        );
        
        if (mysqli_connect_errno()) {
            die("Database connection failed: " .
                mysqli_connect_error() .
                " (" .mysqli_connect_errno() . ")"
               );
        }
    }

    public function closeConn() {
        if(isset($this->conn)) {
            mysqli_close($this->conn);
            unset($this->conn);
        }
    }

    public function query($query) {
        $result = mysqli_query($this->conn, $query);
        $this->confirmQuery($result);
        return $result;
    }

    private function confirmQuery($result) {
        if (!$result) {
            die("Database query failed");
        }
    }

    public function escapeValue($string) {
        $escapedString = mysqli_real_escape_string($this->conn, $string);
        return $escapedString;
    }

    // "database neutral" functions
    public function fetchArray($resultSet) {
        return mysqli_fetch_assoc($resultSet);
    }
    
    public function fetchRow($resultSet) {
        return mysqli_fetch_row($resultSet);
    }

    public function numRows($resultSet) {
        return mysqli_num_rows($resultSet);
    }

    public function insertID() {
        // get the last id inserted over the current db connection
        return mysqli_insert_id($this->conn);
    }

    public function affectedRows() {
        return mysqli_affected_rows($this->conn);
    }

    public function startTransaction() {
        return mysqli_autocommit($this->conn, false);
    }

    public function endTransaction() {
        return mysqli_commit($this->conn);
    }
    
    public function rollbackTransaction() {
        return mysqli_rollback($this->conn);
    }

}

$database = new MySQLDatabase();
$database->openConn();
?>
