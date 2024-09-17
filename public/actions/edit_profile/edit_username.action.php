<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/user.class.php');
require_once (__DIR__ . '/../../../database/book.class.php');

$db = getDatabaseConnection();

$updated = User::editUsername($db, $_GET['username'], $_POST['username']);

if ($updated) {
    $session->setUsername($_POST['username']);
    $session->addMessage('success', 'Username updated successfully!');

    Book::changeSellerUsername($db, $_GET['username'], $_POST['username']);

    header('Location: ../../pages/profile.php?username=' . $_POST['username']);
    exit();
} else {
    $session->addMessage('error', 'Username already exists!');
}

header('Location: ../../pages/profile.php?username=' . $_GET['username']);