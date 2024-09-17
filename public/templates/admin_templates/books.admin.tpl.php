<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
?>

<?php function drawAdminBooks(?array $books)
{ ?>

    <body>
        <div class = "sectionTitle">
        <h2>Books</h2>
        </div>
        <hr>
        <section id="available">
    <button class="message" data-available="3">All</button>
    <button class="message" data-available="2">Sold</button>
    <button class="message" data-available="1">Available</button>
    <button class="message" data-available="0">Removed</button>
</section>
        <?php if (!$books) { ?>
            <p>No books found!</p>
        <?php } else { ?>
            <table id="bookTable" class="book-table">
                <tr>
                    <th>ID</th>
                    <th>Seller</th>
                    <th>Price</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publisher</th>
                    <th>Release Date</th>
                    <th>Condition</th>
                    <th>Tradeable</th>
                    <th>Available</th>
                </tr>

                <?php
                foreach ($books as $book) { ?>
                    <tr>
                        <td><?= $book->id; ?></td>
                        <td><?= $book->seller; ?></td>
                        <td><?= $book->price; ?></td>
                        <td><?= $book->title; ?></td>
                        <td><?= $book->author; ?></td>
                        <td><?= $book->genre; ?></td>
                        <td><?= $book->publisher; ?></td>
                        <td><?= $book->releaseDate; ?></td>
                        <td><?= $book->condition; ?></td>
                        <td><?= $book->isTradeable ? 'Yes' : 'No'; ?></td>
                        <td>
                            <?php
                            if ($book->isAvailable === 0) {
                                echo "Removed";
                            } else if ($book->isAvailable === 1) {
                                echo "Available";
                            } else {
                                echo "Sold";
                            }
                            ?>
                        </td>
                        <td><a href="/../actions/admin_actions/delete_book.action.php?id=<?= $book->id; ?>"><button class = "editButton">Delete
                                    Book</button></a></td>
                    </tr>
                <?php } ?>
            </table>
        </body>

        </html>

    <?php }
} ?>