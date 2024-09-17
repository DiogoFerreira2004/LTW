<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
?>


<?php function drawAdminPage()
{ ?>
    <section class="banner">
        <div class="slogan">
            <h1>ShelfSwap</h1>
            <p class="adminPage">Admin Page</p>
            <a class="admin-link" href="../pages/users.admin.php">Manage Users</a>
            <a class="admin-link" href="../pages/books.admin.php">Manage Books</a>
            <a class="admin-link" href="../pages/genres.admin.php">Manage Genres</a>
        </div>
            
    </section>
<?php } ?>