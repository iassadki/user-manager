<!-- Page qui liste les utilisateurs sous forme de tableau -->
<!-- si user est connecté, alors on voir les utiilisateurs, sinon on affiche la page unauthorized -->
<!-- <?php
session_start();
?> -->

<?php if (isset($_SESSION['user'])) : ?>
    <center><h1>Liste des utilisateurs</h1></center>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Password²</th>
                <th>Last name</th>
                <th>First name</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getPassword() ?></td>
                    <td><?= $user->getFirstName() ?></td>
                    <td><?= $user->getLastName() ?></td>
                    <td><?= $user->getAdmin() ?></td>
                    <!-- emial, pass, fn, ln, ad -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <!-- <h1>Vous n'êtes pas autorisé à accéder à cette page</h1>  -->
    <a href="index.php?controller=user&action=unauthorized">Retour</a>
<?php endif; ?>