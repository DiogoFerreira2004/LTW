<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');

$db = getDatabaseConnection();

Book::rmBook($db, intval($_GET['id']));

header("Location: ../pages/home.php");