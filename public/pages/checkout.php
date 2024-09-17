<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/checkout.tpl.php');

$db = getDatabaseConnection();

$bookIds = User::getCart($db, $session->getId());

foreach ($bookIds as $bookId) {
    $booksInCart[] = Book::getBook($db, intval($bookId));

}

drawHeader($session);
drawRecipe($session, $booksInCart);
foreach ($bookIds as $bookId) {
    $book = Book::getBook($db, intval($bookId));
    Book::setIsAvailable($db, intval($bookId), 2);
    User::rmFromCart($db, intval($bookId), $session->getId());
}
drawFooter();