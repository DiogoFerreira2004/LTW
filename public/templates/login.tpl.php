<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
?>

<?php function drawLogin(Session $session)
{
    $messages = $session->getMessages();
    $mostRecentMessage = end($messages);
    $lastEmailUsed = $session->getLastEmailUsed();

    $session->logout();
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
            <a href="../pages/sign_up.php"><button type="button">SIGN UP</button></a>
        </div>
        <div class="main_container">
            <img src="/images/logo.png" alt="ShelfSwap Logo" style="width:250px">
            <h1>ShelfSwap</h1>
            <h2>Swap Your Stories, Share Your Joy!</h2>
            <form action="../actions/login.action.php" method="post">
                <div class="login_container" id="container">
                    <h1>Welcome Back!</h1>
                    <?php if ($mostRecentMessage['type'] === 'error') { ?>
                        <div class="error-message">
                            <h2><?= $mostRecentMessage['text'] ?></h2>
                        </div>
                    <?php } else if ($mostRecentMessage['type'] === 'success') { ?>
                            <div class="success-message">
                                <h2><?= $mostRecentMessage['text'] ?></h2>
                            </div>
                    <?php } ?>
                    <input type="text" name="email" placeholder="Email" value="<?= $lastEmailUsed ?>">
                    <input type="password" name="password" placeholder="Password">
                    <a href="../pages/home.php">Log in as Guest</a>
                    <button type="submit">LOGIN</button>
                </div>
            </form>
        </div>
    </body>

    </html>

<?php } ?>