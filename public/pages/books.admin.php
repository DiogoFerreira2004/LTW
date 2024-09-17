<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/admin.tpl.php');
require_once (__DIR__ . '/../templates/admin_templates/books.admin.tpl.php');

$db = getDatabaseConnection();

$books = Book::getAllBooks($db, 3);

drawHeader($session);
drawAdminBooks($books);
drawFooter();