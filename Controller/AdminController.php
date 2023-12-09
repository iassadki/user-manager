<?php

class adminController {
    private $userManager;

    public function __construct($db) {
        require_once('./Model/User.php');
        require_once('./Model/UserManager.php');
        $this->userManager = new UserManager($db);
    }

    public function adminPanel() {
        $user = $this->userManager->findByEmail($_SESSION['user']['user']);

        if ($user['admin'] == 1) {
            $page = 'admin';
        } else {
            $page = 'unauthorized';
        }
        require('./View/default.php');
    }

}
