<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/user.class.php');
require_once (__DIR__ . '/../../../database/book.class.php');

$db = getDatabaseConnection();

$books = Book::getBooksForSale($db, $_GET['username']);

foreach ($books as $book) {
    Book::rmBook($db, $book->id);
}

User::deleteUser($db, $_GET['username']);

header('Location: ../../pages/users.admin.php');