<!-- Page qui liste les utilisateurs sous forme de tableau -->
    <div>
    <h2 class="center">List of users</h2>
            <table class="">
            <tr>
                <th>Email</th>
                <th>Password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Admin</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getPassword() ?></td>
                    <td><?= $user->getFirstName() ?></td>
                    <td><?= $user->getLastName() ?></td>
                    <td><?= $user->getAdmin() ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
    </div>