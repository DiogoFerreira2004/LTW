<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');
require_once (__DIR__ . '/../../database/comment.class.php');
$db = getDatabaseConnection();

$book = Book::getBook($db, intval($_POST['bookId']));

Comment::addComment($db, $session->getUsername(), $book->id, $_POST['comment']);

header('Location: ../../pages/book.php?id=' . $book->id);