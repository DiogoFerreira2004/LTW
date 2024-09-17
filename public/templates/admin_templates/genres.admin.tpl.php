<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
?>

<?php function drawAdminGenres(?array $genres, ?array $subGenres)
{ ?>

    <section>
    <div class="sectionTitle">
        <h2>Genres</h2>
    </div>
    <hr>
        <table class = "book-table">
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
            <?php foreach ($genres as $genre) { ?>
                <tr>
                    <td><?= $genre->name ?></td>
                    <td><?= $genre->value ?></td>
                    <?php if ($genre->value !== ''){ ?>
                        <td><a href="/../actions/admin_actions/delete_genre.action.php?id=<?= $genre->id ?>"><button class = "editButton">Delete Genre</button></a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>

        <form action="/../actions/admin_actions/add_genre.action.php" method="post" class = "createGenre">
            <label for="name">Genre:</label>
            <input type="text" id="genre" name="genre" required>
            <button type="submit" class = "editButton">Add Genre</button>
        </form>
    </section>

    <section>
    <div class="sectionTitle">
        <h2>Sub Genres</h2>
    </div>
    <hr>
        <table class = "book-table">
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
            <?php foreach ($subGenres as $subGenre) { ?>
                <tr>
                    <td><?= $subGenre->name ?></td>
                    <td><?= $subGenre->value ?></td>
                    <?php if ($subGenre->value !== ''){ ?>
                        <td><a href="/../actions/admin_actions/delete_sub_genre.action.php?id=<?= $subGenre->id ?>"><button class = "editButton">Delete Sub Genre</button></a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>

        <form action="/../actions/admin_actions/add_sub_genre.action.php" method="post" class = "createGenre">
            <label for="name">Sub Genre:</label>
            <input type="text" id="subGenre" name="subGenre" required>
            <button type="submit" class="editButton">Add Sub Genre</button>
        </form>
    </section>
<?php } ?>