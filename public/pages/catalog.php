<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');
require_once (__DIR__ . '/../../database/genre.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/book.tpl.php');

$db = getDatabaseConnection();

$books = Book::getBooks($db);
$genres = Genre::getAllGenres($db);

drawHeader($session);
drawCatalog($session, $books, $genres);
drawFooter();