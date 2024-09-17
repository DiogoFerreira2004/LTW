<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/genre.class.php');
require_once (__DIR__ . '/../../database/sub_genre.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/add_book.tpl.php');

$db = getDatabaseConnection();

$genres = Genre::getAllGenres($db);
$subGenres = SubGenre::getAllSubGenres($db);

drawHeader($session);
drawAddBook($session, $genres, $subGenres);
drawFooter();