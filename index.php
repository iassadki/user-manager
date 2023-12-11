<?php
session_start();
// La navigation dans l'application s'effectue en adressant à la page index.php 
// à l'aide des deux variables $_GET : ctrl et action
// Exemple: index.php?ctrl=user&action=login 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>EcoSphere - Shop</title>
    <meta name="viewport" content="width=device-width">
    <link href="View/style/general.css" rel="stylesheet" type="text/css">
    <link href="View/style/header-footer.css" rel="stylesheet" type="text/css">
    <link href="View/style/mainSection.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Nunito|Glegoo" rel="stylesheet">
    <script src="./View/js/fontawesome-all.min.js"></script>
    <link href="./View/img/icon.png" rel="icon">
</head>

<body>
<?php
require_once('./Model/Connection.php');
$pdoBuilder = new Connection();
$db = $pdoBuilder->getDb();

if (
    (isset($_GET['ctrl']) && !empty($_GET['ctrl'])) &&
    (isset($_GET['action']) && !empty($_GET['action']))
) {
    $ctrl = $_GET['ctrl'];
    $action = $_GET['action'];
} else {
    $ctrl = 'UserController'; // Nom du controleur par défaut
    $action = 'home';
}

require_once('./Controller/' . $ctrl . '.php'); 

try {
    $controller = new $ctrl($db);
    $controller->$action();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
</body>
</html>
