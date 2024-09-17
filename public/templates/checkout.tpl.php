<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../database/book.class.php');
?>

<?php function drawRecipe(Session $session, ?array $booksInCart)
{
    ?>
    <section class = "payPage">
        <div class="payContainer">
            <div class = "recipeContainer">
            <h1 class="recipeTitle">Recipe</h1>
            <hr>
            <?php foreach ($booksInCart as $book) { ?>
                <div class = "recipeItem">
                <div class = "recipeItemName">
                <p><strong><?= $book->title ?></strong></p>
                </div>
                <div class = "recipePrice">
                <p><strong><?= $book->price ?></strong>$</p>
                </div>
                </div>
            <?php } ?>  
            <?php
                $totalPrice = 0;
                foreach ($booksInCart as $book) {
                    $totalPrice += $book->price;
                }
                ?>
                <p class="recipeTotal">Total: <?= $totalPrice ?>$</p> 
                <hr> 
                <section class="recipe_footer">
            <div class="recipe_footer_box_container">
                <div class="footer_box">
                    <div class="recipe_footer_logo">
                        <img src="../images/logo.png" alt="">
                        <p><strong>ShelfSwap</strong></p>
                    </div>

                    <p>Contact Us: +351 912 345 678</p>
                    <p>Email Us: shelfswap@gmail.com</p>
                    <p>Rua Dr. Roberto Frias, Porto - 4200-465</p>
                    <p>Opening Hours : 9am - 5pm</p>

                </div>

            </div>
        </section>
</div>
        </div>
    </section>
    <?php 
}
?>
