<?php
class Session {

    private $candidateLoggedIn=false;
    public $candidateID;
    public $employerID;
    public $message;
    public $errors;

    function __construct() {
        $this->checkMessage();
        $this->checkCandidateLogin();
        $this->checkEmployerLogin();
        $this->checkErrors();

        if($this->candidateLoggedIn || $this->employerLoggedIn) {
            // session_regenerate_id(true);
        } 
        else {

        }
    }

    // LOGIN & LOGOUT DETAILS
    public function isCandidateLoggedIn() {
        return $this->candidateLoggedIn;
    }

    public function candidateLogin($candidate) {
        // database should find user based on username/password
        if($user){
            $this->candidateID = $_SESSION['candidateID'] = $candidate->candidateID;
            $this->candidateLoggedIn = true;
        }
    }

    public function candidateLogout() {
        unset($_SESSION['candidateID']);
        unset($this->candidateID);
        $this->candidateLoggedIn = false;
    }

    private function checkCandidateLogin() {
        if(isset($_SESSION['candidateID'])) {
            $this->candidateID = $_SESSION['candidateID'];
            $this->candidateLoggedIn = true;
        } else {
            unset($this->candidateID);
            $this->candidateLoggedIn = false;
        }
    }


        // ADMIN LOGIN & LOGOUT DETAILS
        public function isEmployerLoggedIn() {
            return $this->employerLoggedIn;
        }
    
        public function employerLogin($employer) {
            if($admin){
                $this->employerID = $_SESSION['employerID'] = $employerID;
                $this->employerLoggedIn = true;
            }
        }
    
        public function employerLogout() {
            unset($_SESSION['employerID']);
            unset($this->employerID);
            $this->employerLoggedIn = false;
        }
    
        private function checkEmployerLogin() {
            if(isset($_SESSION['employerID'])) {
                $this->employerID = $_SESSION['employerID'];
                $this->employerLoggedIn = true;
            } else {
                unset($this->employerID);
                $this->employerLoggedIn = false;
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
        if(!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            return $this->errors;
        }
    }
}

$session = new Session();
$message = $session->message();