<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');
require_once (__DIR__ . '/../../database/genre.class.php');
require_once (__DIR__ . '/../../database/sub_genre.class.php');
require_once (__DIR__ . '/../../database/comment.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/book.tpl.php');

$db = getDatabaseConnection();

$book = Book::getBook($db, intval($_GET['id']));

$genres = Genre::getAllGenres($db);
$subGenres = SubGenre::getAllSubGenres($db);

$comments = Comment::getComments($db, intval($_GET['id']));

foreach ($comments as $comment) {
    $comment->replies = Reply::getReplies($db, $comment->id);
}

drawHeader($session);
drawBook($session, $book, $genres, $subGenres, $comments);
drawFooter();
