<?php
declare(strict_types=1);

require_once(__DIR__ . '/../../database/book.class.php');

function drawWishList(User $user, ?array $booksInWishList, Session $session)
{
    ?>
    <div class="userInfoGeral">
        <img src="../images/user_uploads/<?= $user->profilePic ?>" class="userPicture">
        <div class="userInfo">
            <h1><?= $user->username ?></h1>
            <div class="nome">
                <h3>Name:</h3>
                <p><?= $user->name ?></p>
            </div>
        </div>
            <a href="../pages/profile.php?username=<?= $session->getUsername() ?>" class="messageMe"><button>Your Library</button></a>
        
    </div>

    <div class = "sectionTitle">
    <h2>Wishlist:</h2>
    </div>
    <hr>
    <?php if (!($booksInWishList)) { ?>
        <div class = "emptyCar">
        <img src="../images/no_books.png" alt="" height=400em>
        <h2>Your Wishlist is empty!</h2>
        </div>
    <?php } else { ?>
        <section class="booksInCart">
            <div class = "bookContainer">
            <?php foreach ($booksInWishList as $book) { ?>
                <article>
                <a href="../pages/profile.php?username=<?= $book->seller ?>">
                    <p class = "bookCartSeller"><?= $book->seller ?></p>
                    </a>
                    <a href="../pages/book.php?id=<?= $book->id ?>">
                    <img src="../images/user_uploads/<?= $book->imagePath ?>" class = "bookCartPicture">
                    <p class = "bookCartTitle"><?= $book->title ?></p>
                    <p class = "bookCartPrice"><?= $book->price ?>$</p>
                    </a>
                    <a href="../actions/rm_from_wishlist.action.php?id=<?= $book->id; ?>&username=<?= $book->seller; ?>" class = "removeCart"><button>Remove from wishlist</button></a>
                </article>
                </a>
            <?php } ?>
            </div>
        <?php }
} ?>