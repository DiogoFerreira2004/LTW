<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../database/book.class.php');
?>

<?php function drawAddBook(Session $session, array $genres, array $subGenres)
{
    $messages = $session->getMessages();
    $mostRecentMessage = end($messages);
    ?>

    <h2>Add Book</h2>
    <form action="../actions/add_book.action.php" method="post" enctype="multipart/form-data">
        <div class="add_book">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept=".png, .jpeg, .jpg" required>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="genre">Genre:</label>
            <select id="genre" name="genre" required>
                <?php foreach ($genres as $genre) {
                    if ($genre->value != '') { ?>
                        <option value="<?= $genre->value ?>"><?= $genre->name ?></option>
                    <?php }
                } ?>
            </select>

            <label for="subGenre">Sub-Genre:</label>
            <select id="subGenre" name="subGenre">
                <?php foreach ($subGenres as $subGenre) { ?>
                    <option value="<?= $subGenre->value ?>"><?= $subGenre->name ?></option>
                <?php } ?>
            </select>

            <label for="publisher">Publisher:</label>
            <input type="text" id="publisher" name="publisher" required>

            <label for="releaseDate">Release Date:</label>
            <input type="date" id="releaseDate" name="releaseDate" required>

            <label for="condition">Condition:</label>
            <select id="condition" name="condition" required>
                <option value="new">New</option>
                <option value="good">Good</option>
                <option value="used">Used</option>
                <option value="poor">Poor</option>
            </select>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="isTradeable">Tradeable:</label>
            <input type="checkbox" id="isTradeable" name="isTradeable">

            <button type="submit" value="Add Book">Add Book</button>
        </div>
    </form>

    <?php if ($mostRecentMessage['type'] === 'error') { ?>
        <div class="error-message">
            <h3><?= $mostRecentMessage['text'] ?></h3>
        </div>
    <?php } else if ($mostRecentMessage['type'] === 'success') { ?>
            <div class="success-message">
                <h3><?= $mostRecentMessage['text'] ?></h3>
            </div>
    <?php } ?>

<?php } ?>