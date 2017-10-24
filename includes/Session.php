<?php
class Session {

    private $loggedIn=false;
    public $id;
    public $message;
    public $errors;

    function __construct() {
        // session_start();
        $this->checkMessage();
        $this->checkErrors();
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

    public function login($user) {
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

    // session error display
    private function checkErrors() {
        if(isset($_SESSION['errors'])) {
            $this->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        } else {
            $this->errors = "";
        }

    }
    
    public function errors($errors = "") {
        if(!empty($error)) {
            $_SESSION['errors'] = $errors;
        } else {
            return $this->errors;
        }
    }
}

$session = new Session();
$message = $session->message();