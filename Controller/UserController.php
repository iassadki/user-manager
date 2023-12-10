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

    // public function display() {
    //     $page = 'home';
    //     $user = null;
    //     $admin = false;
    //     if (isset($_SESSION['user']['email'])) {
    //         $user = $this->userManager->findByEmail($_SESSION['user']['email']);
    //         if ($user['admin'] == 1) {
    //             $admin = true;
    //         }
    //     }
    //     require('./View/default.php');
    // }

    public function login() {
        $page = 'login';
        require('./View/default.php');
    }

    public function doLogin() {
        $email = $_POST['email']; 
        $password = $_POST['password']; 

        // Le user extrait par le UserManager est renvoyé dans $result
        // A vous d'écrire les 3 lignes correspondantes
        $result = $this->userManager->login($email, $password);        
        // $result = //_____ ;

        // if ( $result ) :
        //     $info = "Connexion reussie";
        //     $_SESSION['user'] = $result;
        //     $page = 'home';
        // else :
        //     $info = "Identifiants incorrects.";
        // endif;

        $erreurConn = "";

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
            $error = "ERROR : The email (" . $_POST['email'] . ") is already used by another user";
            $page = 'createAccount';
        }
        }
        require('./View/default.php');
    }

    public function create() {
        $page = 'createAccount';
        require('./View/default.php');
    }

    // public function delete() {
    //     $id = $_GET['id'];
    //     $this->userManager->delete($id);
    //     $users = $this->userManager->findAll();
    //     $page = 'usersList';
    //     require('./View/default.php');
    // }

    // fonction unauthorized
    public function unauthorized() {
        $page = 'unauthorized';
        require('./View/default.php');
    }

    // fonction usersList
    public function usersList() {
        if (isset($_SESSION['user'])) {
            $users = $this->userManager->findAll();
            $page = 'usersList';
        	require('./View/default.php');
        } else if (isset($_SESSION['admin']) && $user['admin'] == 1) { // $result = $this->userManager->login($email, $password); __ $result['admin'] == 1  
            $users = $this->userManager->findAll();
            $page = 'usersListAdmin';
        	require('./View/default.php'); 
        } else {
        	$page = 'unauthorized';
        	require('./View/default.php');
        }   
    }

}