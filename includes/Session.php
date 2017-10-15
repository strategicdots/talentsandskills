<?php
class Session {

    private $loggedIn=false;
    public $id;
    public $message;

    function __construct() {
        // session_start();
        $this->checkMessage();
        $this->checkLogin();

        if($this->loggedIn) {
             // session_regenerate_id(true);
        } 
        else {

        }
    }

    // LOGIN & LOGOUT DETAILS
    public function isLoggedIn() {
        return $this->loggedIn;
    }
    public function login($admin) {
        // database should find user based on username/password
        if($user){
            $this->id = $_SESSION['id'] = $user->id;
            $this->loggedIn = true;
        }
    }
    public function logout() {
        unset($_SESSION['id']);
        unset($this->id);
        $this->loggedIn = false;
    }
    private function checkLogin() {
        if(isset($_SESSION['id'])) {
            $this->id = $_SESSION['id'];
            $this->loggedIn = true;
        } else {
            unset($this->id);
            $this->loggedIn = false;
        }
    }

    // SESSION MESSAGES
    private function checkMessage() {
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
    public function message($msg="") {
        if(!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }
}

$session = new Session();
$message = $session->message();

?>
