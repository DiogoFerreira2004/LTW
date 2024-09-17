<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
?>

<?php function drawSignUp(Session $session)
{
    $messages = $session->getMessages();
    $mostRecentMessage = end($messages);
    ?>

    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>ShelfSwap</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/login_sign_up.css">
        <script src="../js/input_text.js" defer></script>
    </head>

    <body>
        <div class="corner_button">
            <a href="../pages"><button type="button">LOGIN</button></a>
        </div>
        <div class="main_container">
            <h1>Welcome!</h1>
            <h2>Thank You For Joining Us!</h2>
            <form action="../actions/sign_up.action.php" method="post" novalidate>
                <div class="sign_up_container" id="container">
                    <h1>Sign Up!</h1>
                    <?php if ($mostRecentMessage['type'] === 'error') { ?>
                        <div class="error-message">
                            <h2><?= $mostRecentMessage['text'] ?></h2>
                        </div>
                    <?php } ?>
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="text" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="r_password" placeholder="Confirm Password" required>
                    <button type="submit">SIGN UP</button>
                </div>
            </form>
        </div>
    </body>

    </html>

<?php } ?>