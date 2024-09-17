<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/comment.class.php');
$db = getDatabaseConnection();

Reply::addReply($db, $session->getUsername(), intval($_POST['commentId']), $_POST['replyText']);

header('Location: ../../pages/book.php?id=' . $_POST['bookId']);