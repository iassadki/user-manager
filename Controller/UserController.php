<?php

class userController {
    private $userManager;
    private $user;
 
    public function __construct($db) {
        require('./Model/User.php');
        require_once('./Model/UserManager.php');
        $this->userManager = new UserManager($db);
    }

    public function home() {
        $page = 'home';
        require('./View/default.php');
    }

    public function homeUser() {
        $page = 'homeUser';
        require('./View/default.php');
    }

    public function homeAdmin() {
        $page = 'homeAdmin';
        require('./View/default.php');
    }

    public function login() {
        $page = 'login';
        require('./View/default.php');
    }

    public function doLogin() {
        $email = $_POST['email']; 
        $password = $_POST['password']; 

        $result = $this->userManager->login($email, $password);        

        if ($result) {
            $info = "Connexion reussie";
            $_SESSION['user'] = $result;
            if ($result['admin'] == 1) {
                $page = 'homeAdmin';
            } else {
                $page = 'homeUser';
            }
        } else {
            $error = "The email or password is incorrect";
            $page = 'login';
        }
        
        require('./View/default.php');
    }

    public function doLogout() {
        unset($_SESSION['user']);
        $page = 'home';
        require('./View/default.php');
    }

    public function doCreate(){
        if (isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['lastName']) &&
            isset($_POST['firstName']) &&
            isset($_POST['address']) &&
            isset($_POST['postalCode']) &&
            isset($_POST['city'])) {

        $alreadyExist = $this->userManager->findByEmail($_POST['email']);
        
        if (!$alreadyExist) {
            $newUser = new User($_POST);
            $this->userManager->create($newUser); // 
            $page = 'login';
        } else {
            $error = "The email (" . $_POST['email'] . ") is already used by another user";
            $page = 'createAccount';
        }
        }
        require('./View/default.php');
    }

    public function create() {
        $page = 'createAccount';
        require('./View/default.php');
    }

    public function unauthorized() {
        $page = 'unauthorized';
        require('./View/default.php');
    }

    public function usersList() {
        if (isset($_SESSION['user'])) {
            $users = $this->userManager->findAll();
            $page = 'usersList';
        	require('./View/default.php');
        } else if (isset($_SESSION['admin']) && $user['admin'] == 1) {
            $users = $this->userManager->findAll();
            $page = 'usersListAdmin';
        	require('./View/default.php'); 
        } else {
        	$page = 'unauthorized';
        	require('./View/default.php');
        }   
    }
}