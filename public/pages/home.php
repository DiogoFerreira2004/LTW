<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/book.tpl.php');

$db = getDatabaseConnection();

$books = Book::getRecentBooks($db);

drawHeader($session);
drawHome();
drawShowBooks($books);
drawFooter();