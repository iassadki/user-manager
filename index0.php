<?php
include 'Model/Connection.php';
include 'Model/User.php';
include 'Model/UserManager.php';

$connection = new Connection();
try {
    $db = $connection->getDb();
    // Use $db for your database operations
} catch (RuntimeException $e) {
    echo $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donnees = array(
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'address' => $_POST['address'],
        'postalCode' => $_POST['postalCode'],
        'city' => $_POST['city'],
        'admin' => 0
    );
    $user = new User($donnees);

    $co = new Connection();
    $manager = new UserManager($co->getDb());
    $manager->create($user);
}

include 'View/createAccount.php';
