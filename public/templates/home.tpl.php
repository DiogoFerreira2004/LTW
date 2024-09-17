<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session)
{ ?>

    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>ShelfSwap</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/home.css" rel="stylesheet">
        <link href="../css/book.css" rel="stylesheet">
        <link href="../css/cart.css" rel="stylesheet">
        <link href="../css/profile.css" rel="stylesheet">
        <link href="../css/payment.css" rel="stylesheet">
        <link href="../css/checkout.css" rel="stylesheet">
        <link href="../css/comment.css" rel="stylesheet">
        <link href="../css/admin.css" rel="stylesheet">
        <script src="../js/search_bar.js" defer></script>
        <script src="../js/replies.js" defer></script>
        <script src="../js/valid_month.js" defer></script>
        <script src="../js/valid_year.js" defer></script>
        <script src="../js/valid_zipCode.js" defer></script>
        <script src="../js/valid_city.js" defer></script>
        <script src="../js/valid_cardNumber.js" defer></script>
        <script src="../js/valid_cvv.js" defer></script>
        <script src="../js/input_text.js" defer></script>
        <script src="../js/admin_book.js" defer></script>
    </head>

    <body>

        <header class="user_header">
            <div class="header">
                <div class="user_flex">
                    <div class="logo_header">
                        <img src="../images/logo.png" alt="" height=50px>
                        <a href="../pages/home.php" class="logo">ShelfSwap</a>
                    </div>

                    <div class="is_logged_in">
                        <?php if (!$session->isLoggedIn()) { ?>
                            <p><a href="../pages">Login</a> | <a href="../pages/sign_up.php">Sign Up</a></p>
                        <?php } else {
                            if($session->isAdmin()) { ?>
                                <p><a href="../pages/admin.php">Admin Panel</a> | <a href="../pages/profile.php?username=<?= $session->getUsername() ?>"><?= $session->getName() ?></a> | <a href="../pages/cart.php">Shopping Cart</a> | <a href="../pages">Logout</a></p>
                            <?php } else { ?>
                            <p><a href="../pages/profile.php?username=<?= $session->getUsername() ?>"><?= $session->getName() ?></a> | <a href="../pages/cart.php">Shopping Cart</a> | <a href="../pages">Logout</a></p>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>

        </header>

        <main>

        <?php } ?>

        <?php function drawHome()
        {
            ?>
            <section class="banner">
                <div class="slogan">
                    <h1>ShelfSwap</h1>
                    <p>Swap Your Stories, Share Your Joy!</p>
                    <a href="../pages/catalog.php"><button>Browse Catalog</button></a>
                </div>
            </section>
    <?php } ?>

    <?php function drawShowBooks(array $books)
    { ?>
        <section class="books">
            <div class="sectionTitle">
                <h2>Recent Additions:</h2>
            </div>
            <hr>
        <div class = "bookContainer">
            <?php foreach ($books as $book) { ?>
                <article>
                    <a href="../pages/profile.php?username=<?= $book->seller ?>">
                    <p class = "bookSeller"><?= $book->seller ?></p>
                    </a>
                    <a href="../pages/book.php?id=<?= $book->id ?>">
                    <img src="../images/user_uploads/<?= $book->imagePath ?>" class = "bookPicture">
                    <p class = "bookTitle"><?= $book->title ?></p>
                    <p class = "bookPrice"><?= $book->price ?>$</p>
                    </a>
                </article>
            <?php } ?>
            </div>
        </section>
    <?php } ?>

        <?php function drawFooter()
        { ?>
        </main>

        <section class="footer">
            <div class="footer_box_container">
                <div class="footer_box">
                    <div class="footer_logo">
                        <img src="../images/logo.png" alt="">
                        <a href="../pages/home.php" class="logo">ShelfSwap</a>
                    </div>

                    <p><a href="../pages/home.php">Click Me!</a></p>

                    <p>Contact Us: +351 912 345 678</p>
                    <p>Email Us: shelfswap@gmail.com</p>
                    <p>Rua Dr. Roberto Frias, Porto - 4200-465</p>
                    <p>Opening Hours : 9am - 5pm</p>

                </div>
                <!-- Could add more things here, but ran out of creative juice -->
            </div>
        </section>

        <div class="copyright">
            <p>Copyright &copy; 2024 <span>ShelfSwap | Not a Single Right Reserved!</span></p>
        </div>

    </body>

    </html>

<?php } ?>