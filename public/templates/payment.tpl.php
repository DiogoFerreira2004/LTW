<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../database/book.class.php');
?>

<?php function drawPayment(Session $session, ?array $booksInCart)
{
    ?>
    <section class = "payPage">
        <div class="payContainer">
            <form action="checkout.php" method="post">
                <div class="row">
                    <div class="column">
                        <h1 class="payTitle">Billing Address</h1>
                        <div class="input-box">
                            <span>Full Name: </span>
                            <input type="text" name="full_name" placeholder="Insert your name" required>
                        </div>
                        <div class="input-box">
                            <span>Email: </span>
                            <input type="email" name="email" placeholder="Insert your email" required>
                        </div>
                        <div class="input-box">
                            <span>Address: </span>
                            <input type="text" name="address" placeholder="Insert your address" required>
                        </div>
                        <div class="input-box">
                            <span>City: </span>
                            <input type="text" name="city" placeholder="Insert your City" required>
                        </div>
                        <div class="flex">
                            <div class="input-box">
                                <span>Country: </span>
                                <select name="country" id="country" required>
        <option value="" disabled selected>Select your country</option>
        <option value="Portugal">Portugal</option>
        <option value="Angola">Angola</option>
<option value="Argentina">Argentina</option>
<option value="Australia">Australia</option>
<option value="Belgium">Belgium</option>
<option value="Brazil">Brazil</option>
<option value="Canada">Canada</option>
<option value="China">China</option>
<option value="Colombia">Colombia</option>
<option value="Croatia">Croatia</option>
<option value="Egypt">Egypt</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Iceland">Iceland</option>
<option value="Ireland">Ireland</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Mexico">Mexico</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Nigeria">Nigeria</option>
<option value="Norway">Norway</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Poland">Poland</option>
<option value="Russia">Russia</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="South Africa">South Africa</option>
<option value="South Korea">South Korea</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Thailand">Thailand</option>
<option value="Turkey">Turkey</option>
<option value="UK">UK</option>
<option value="USA">USA</option>
<option value="Ukrania">Ukrania</option>
<option value="Uruguay">Uruguay</option>
<option value="Other">Other</option>
        <!-- Add more country options as needed -->
    </select>
                            </div>
                            <div class="input-box">
                                <span>ZIP-CODE: </span>
                                <input type="text" name="zip_code" id="zip_code" placeholder="ZIP-CODE" required>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <h1 class="payTitle">Payment</h1>
                        <div class="input-box">
                            <span>Cards Accepted: </span>
                            <img src="../images/imgcards.png">
                        </div>
                        <div class="input-box">
                            <span>Name On Card: </span>
                            <input type="text" name="card_name" placeholder="Insert the card owner's name" required>
                        </div>
                        <div class="input-box">
                            <span>Credit Card Number: </span>
                            <input type="number" name="card_number" id="cardNumberInput" placeholder="Insert the credit card number" required minlength="16">

                        </div>
                        <div class="input-box">
                            <span>Exp. Month: </span>
                            <input type="number" name="exp_month" id="expMonthInput" placeholder="Insert the expiration month" required min="1" max="12">
</div>
                        <div class="flex">
                            <div class="input-box">
                                <span>Exp. Year: </span>
                                <input type="number" name="exp_year" id="expYearInput" placeholder="Year" required>
                            </div>
                            <div class="input-box">
                                <span>CVV: </span>
                                <input type="number" name="cvv" id="cvvInput" placeholder="CVV" required minlength="3" maxlength="3">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $totalPrice = 0;
                foreach ($booksInCart as $book) {
                    $totalPrice += $book->price;
                }
                ?>
                    <p class="total">Total: <?= $totalPrice ?>$</p>
                    <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </section>
    <?php 
}
?>
