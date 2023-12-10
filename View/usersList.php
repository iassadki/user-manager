<!-- Page qui liste les utilisateurs sous forme de tableau -->
<!-- si user est connecté, alors on voir les utiilisateurs, sinon on affiche la page unauthorized -->
<?php if (isset($_SESSION['user'])) : ?>
    <center><h1>Users List - User Profile</h1></center>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Password</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <a href="index.php?controller=user&action=unauthorized">Retour</a>
<?php endif; ?>
