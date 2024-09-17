<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
?>

<?php function drawAdminUsers(?array $users)
{ ?>

    <body>
    <div class = "sectionTitle">
        <h2>Users</h2>
        </div>
        <hr>
        <?php if (!$users) { ?>
            <p>No users found!</p>
        <?php } else { ?>
            <table class = "book-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin</th>
                </tr>
                <?php

                foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td><?= $user->name; ?></td>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><?= $user->isAdmin ? 'Yes' : 'No'; ?></td>
                        <?php if (!$user->isAdmin) { ?>
                            <td><a href="/../actions/admin_actions/make_admin.action.php?id=<?= $user->id; ?>"><button class = "editButton">Make
                                        Admin</button></a></td>
                            <td><a href="/../actions/admin_actions/delete_user.action.php?username=<?= $user->username ?>"><button class = "editButton">Delete
                                        User</button></a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        </body>

        </html>

    <?php }
} ?>