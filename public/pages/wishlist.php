<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/wishlist.tpl.php');

$db = getDatabaseConnection();

$user = User::getUser($db, $_GET['username']);
$bookIds = User::getWishlist($db, $session->getId());

foreach ($bookIds as $bookId) {
    $booksInWishList[] = Book::getBook($db, intval($bookId));
}

drawHeader($session);
drawWishList($user, $booksInWishList, $session);
drawFooter();
