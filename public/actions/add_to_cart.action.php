<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

if (!$session->isLoggedIn()) {
    $session->addMessage('error', 'You must be logged in to add books to cart!');
    header('Location: ../pages/book.php?id=' . $_GET['id']);
    exit();
}

$db = getDatabaseConnection();
$added = User::addToCart($db, intval($_GET['id']), $session->getId());

if ($added) {
    $session->addMessage('success', 'Book added to cart!');
} else {
    $session->addMessage('error', 'Book already in cart!');
}

header('Location: ../pages/book.php?id=' . $_GET['id']);