<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/payment.tpl.php');

$db = getDatabaseConnection();

$bookIds = User::getCart($db, $session->getId());

foreach ($bookIds as $bookId) {
    $booksInCart[] = Book::getBook($db, intval($bookId));
}

drawHeader($session);
drawPayment($session, $booksInCart);
drawFooter();