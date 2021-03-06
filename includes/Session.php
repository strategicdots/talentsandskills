<?php require_once('initialize.php');

class Session {
    
    // user login & logout activities
    private $candidateLoggedIn = false;
    private $employerLoggedIn = false;
    private $internLoggedIn = false;
    private $adminLoggedIn = false;
    public $candidateID;
    public $employerID;
    public $internID;
    public $adminID;
    
    // other session settings
    public $message;
    public $errors;  
    public $postValues; 
    public $fileValues; 

    function __construct() {
        $this->checkMessage();
        $this->checkCandidateLogin();
        $this->checkEmployerLogin();
        $this->checkInternLogin();
        // $this->checkAdminLogin();
        $this->checkErrors();
        $this->checkPostValues();
        $this->checkFileValues();

        if(
            $this->candidateLoggedIn || 
            $this->employerLoggedIn  ||
            $this->internLoggedIn  ||
            $this->adminLoggedIn  
        ) 
        {

            session_regenerate_id(true);
            $this->checkUserActivity();
        
        } 
        else {

        }
    }


    public function checkUserActivity() {
        
        // SESSION TIMEOUT FUNCTION
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
        
        // last request was more than 1 hour ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        
        redirect_to("/talents/login.php"); //redirect to login page for new login activity
        
        } else { 
    
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity timestamp

        }
    }

    // CANDIDATE LOGIN & LOGOUT DETAILS

    #region
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

    #endregion

    // INTERN LOGIN & LOGOUT DETAILS

    #region
    public function isInternLoggedIn()
    {
        return $this->internLoggedIn;
    }

    public function internLogin($intern)
    {
        // database should find user based on username/password
        if ($user) {
            $this->internID = $_SESSION['internID'] = $intern->internID;
            $this->internLoggedIn = true;
        }
    }

    public function internLogout()
    {
        unset($_SESSION['internID']);
        unset($this->internID);
        $this->internLoggedIn = false;
    }

    private function checkInternLogin()
    {
        if (isset($_SESSION['internID'])) {
            $this->internID = $_SESSION['internID'];
            $this->internLoggedIn = true;
        } else {
            unset($this->internID);
            $this->internLoggedIn = false;
        }
    }

    #endregion

    // EMPLOYER LOGIN & LOGOUT DETAILS

    #region
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
    #endregion


    // session messages
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

    // session error displays
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


    // session $_POST setters and getters
    private function checkPostValues()
    {
        if (isset($_SESSION['POST'])) {
            $this->postValues = $_SESSION['POST'];
            unset($_SESSION['POST']);
        } else {
            $this->postValues = "";
        }

    }

    public function postValues($postValues = "")
    {
        if (!empty($postValues)) {
            $_SESSION['POST'] = $postValues;
        } else {
            return $this->postValues;
        }
    }


    // session $_FILES setters and getters
    private function checkFileValues()
    {
        if (isset($_SESSION['FILES'])) {
            $this->fileValues = $_SESSION['FILES'];
            unset($_SESSION['FILES']);
        } else {
            $this->fileValues = "";
        }

    }

    public function fileValues($fileValues = "")
    {
        if (!empty($fileValues)) {
            $_SESSION['FILES'] = $fileValues;
        } else {
            return $this->fileValues;
        }
    }
}

$session = new Session();
$message = $session->message();
