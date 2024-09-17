<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../database/book.class.php');
?>

<?php function drawCart(Session $session, ?array $booksInCart)
{
    $messages = $session->getMessages();
    $mostRecentMessage = end($messages);

    ?>
   <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Shopping Cart</h1>
    <a href="../pages/payment.php" class="buyButton"><button>Buy Your Books</button></a>
</div>
    <hr>
    <?php if (empty($booksInCart)) { ?>
        <div class = "emptyCar">
        <img src="../images/empty_cart.png" alt="" height=500em>
        <h2>Your cart is empty!</h2>
        </div>
    <?php } else { ?>
        <section class="booksInCart">
            <div class = "bookContainer">
            <?php foreach ($booksInCart as $book) { ?>
                <article>
                    <a href="../pages/profile.php?username=<?= $book->seller ?>">
                    <p class = "bookCartSeller"><?= $book->seller ?></p>
                    </a>
                    <a href="../pages/book.php?id=<?= $book->id ?>">
                    <img src="../images/user_uploads/<?= $book->imagePath ?>" class = "bookCartPicture">
                    <p class = "bookCartTitle"><?= $book->title ?></p>
                    <p class = "bookCartPrice"><?= $book->price ?>$</p>
                    </a>
                    <a href="../actions/rm_from_cart.action.php?id=<?= $book->id; ?>" class = "removeCart"><button>Remove from cart</button></a>
                </article>
            <?php } ?>
            </div>
            <?php if ($mostRecentMessage['type'] === 'success') { ?>
                <div class="success-message">
                    <h3><?= $mostRecentMessage['text'] ?></h3>
                </div>
            <?php } ?>
        <?php }
} ?>