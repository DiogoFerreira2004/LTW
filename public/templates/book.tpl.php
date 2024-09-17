<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../database/book.class.php');
?>

<?php function drawCatalog(Session $session, array $books, array $genres)
{ ?>
    <section class="banner">
        <div class="slogan">
            <h1>ShelfSwap</h1>
            <p>Swap Your Stories, Share Your Joy!</p>
            <div class="search-container">
                <input id="searchBook" type="text" placeholder="search">
            </div>
        </div>
    </section>
    <section id="genres">
        <?php foreach ($genres as $genre){ ?>
            <button data-genre="<?= $genre->value ?>"><?= $genre->name ?></button>
        <?php }?>
    </section>

    <div class="priceFilter">
        <label for="max_price">Max Price:</label>
        <input id="priceFilter" type="numeric" step="0.01">
    </div>
    
    <section class="books" id="books">
        <div class="bookContainer">
            <?php foreach ($books as $book) { ?>
                <article>
                    <a href="../pages/profile.php?username=<?= $book->seller ?>">
                        <p class="bookSeller"><?= $book->seller ?></p>
                    </a>
                    <a href="../pages/book.php?id=<?= $book->id ?>">
                        <img src="../images/user_uploads/<?= $book->imagePath ?>" class="bookPicture">
                        <p class="bookTitle"><?= $book->title ?></p>
                        <p class="bookPrice"><?= $book->price ?>$</p>
                    </a>
                </article>
            <?php } ?>
        </div>
    </section>

    <?php if ($session->isLoggedIn()){ ?>
    <a href="../pages/add_book.php" class="center-button"><button class="editButton">Add Book</button></a>
<?php }?>
<?php }

function drawBook(Session $session, Book $book, array $genres, array $subGenres, array $comments)
{
    ?>
    <h1>
        <h2><?= $book->title ?></h2>
    </h1>
    <section id="book">
        <div class="leftSide">
            <img src="../images/user_uploads/<?= $book->imagePath ?>">
        </div>
        <div class="rightSide">
                    <?php if ($session->getUsername() === $book->seller) { ?>
                        <form action="../actions/edit_book_info.action.php?id=<?= $book->id ?>"  method="post" class="payContainer">
                            <div class="containerEdit">
                            <section class="info">
                            <div class="form-content">
                                <div class="row">
                                    <div class="column">
                                        <div class="input-box">
                                            <span>Title: </span>
                                            <input type="text" id="title" name="title" value="<?= $book->title; ?>">
                                        </div>
                                        <div class="input-box">
                                            <span>Author: </span>
                                            <input type="text" id="author" name="author" value="<?= $book->author; ?>">
                                        </div>
                                        <div class="input-box">
                                            <span>Genre: </span>
                                            <select id="genre" name="genre" required>
                                                <?php foreach ($genres as $genre){ 
                                                    if ($genre->value != ''){ ?>
                                                        <option value="<?= $genre->value ?>"><?= $genre->name ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="input-box">
                                            <span>Sub-Genre: </span>
                                            <select id="subGenre" name="subGenre">
                                                <?php foreach ($subGenres as $subGenre){ ?>
                                                    <option value="<?= $subGenre->value ?>"><?= $subGenre->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <p><strong>Current Genres:</strong> <?= $book->genre ?></p>
                                        <div class="input-box">
                                            <span>Publisher: </span>
                                            <input type="text" id="publisher" name="publisher" value="<?= $book->publisher; ?>">
                                        </div>
                                        </div>
                                    <div class="column">
                                        <div class="input-box">
                                            <span>Release Date: </span>
                                            <input type="date" id="releaseDate" name="releaseDate" value="<?= $book->releaseDate; ?>">
                                        </div>
                                        <p><strong>Current Release Date:</strong> <?= $book->releaseDate ?></p>
                                        <div class="input-box">
                                            <span>Condition: </span>
                                            <select id="condition" name="condition" required>
                                                <option value="new">New</option>
                                                <option value="good">Good</option>
                                                <option value="used">Used</option>
                                                <option value="poor">Poor</option>
                                            </select>
                                        </div>
                                        <p><strong>Current Condition:</strong> <?= $book->condition ?></p>
                                        <div class="input-box">
                                            <span>Price: </span>
                                            <input type="number" id="price" name="price" value="<?= $book->price; ?>" step="0.01">
                                        </div>
                                        <div class="input-box">
                                            <span>Tradeable: </span>
                                            <input type="checkbox" id="isTradeable" name="isTradeable" <?= $book->isTradeable ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="flex">
                                    <button type="submit" class="btn btn-edit">Edit Book</button>
                                    <a href="../actions/rm_book.action.php?id=<?= $book->id; ?>" class="btn btn-remove">Remove Book</a>
                                </div>
                            </section>
                            </div>
                            </>
                        </form>
                        </section>
                    
                    <?php } else { ?>
                        <div class="container">
                <section class="info">
                        <p><strong>Author: </strong><?= $book->author ?></p>
                        <p><strong>Genre: </strong><?= $book->genre ?></p>
                        <p><strong>Publisher: </strong><?= $book->publisher ?></p>
                        <p><strong>Release Date: </strong><?= $book->releaseDate ?></p>
                        <p><strong>Condition: </strong><?= $book->condition ?></p>
                        <p><strong>Price: </strong><?= $book->price ?>€</p>
                        <p><strong>Tradeable: </strong><?= $book->isTradeable ? 'Yes' : 'No' ?></p>
                        <a href="../actions/add_to_cart.action.php?id=<?= $book->id; ?>" class="addCart"><button>Add to cart</button></a>
                        <a href="../actions/add_to_wishlist.action.php?id=<?= $book->id; ?>" class="wishlist"><button>Add to wishlist</button></a>
                    <?php } ?>
                </section>
            </div>
    </section>
    <section class="commentsContainer">
    <div class = "sectionTitle">
    <h2>Comments</h2>
    <hr>
    </div>
    <?php foreach ($comments as $comment) { ?>
            <div class="commentContainer" data-comment-id="<?= $comment->id ?>">
                <a href="../pages/profile.php?username=<?= $comment->user ?>"><p class="commentUser"><?= $comment->user ?></p></a>
                <p class="commentContent"><?= $comment->comment ?></p>
                <p class="commentDate"><?= $comment->createdAt ?></p>
                <button class="reply-button btn-reply">Reply</button>
                <div class="replies">
                    <?php foreach ($comment->replies as $reply) { ?>
                        <div class="replyContainer">
                            <a href="../pages/profile.php?username=<?= $reply->user ?>"><p class="replyUser"><?= $reply->user ?></p></a>
                            <p class="replyContent"><?= $reply->reply ?></p>
                            <p class="replyDate"><?= $reply->createdAt ?></p>
                        </div>
                    <?php } ?>
                </div>
                <div class="reply-form">
                    <form action="../actions/add_reply.action.php" method="post">
                        <input type="hidden" name="commentId" value="<?= $comment->id ?>">
                        <input type="hidden" name="bookId" value="<?= $book->id ?>">
                        <textarea name="replyText" class="replyWrite" placeholder="Write your reply"></textarea>
                        <button type="submit">Submit</button>
                        <button type="button">Cancel</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        <form action="../actions/add_comment.action.php" method="post">
            <input type="hidden" name="bookId" value="<?= $book->id ?>">
            <textarea name="comment" class="commentWrite" placeholder="Write your comment"></textarea>
            <button type="submit" class="editButton">Submit</button>
        </form>
    </section>
<?php }
?>
