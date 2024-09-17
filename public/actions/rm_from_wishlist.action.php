<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

$db = getDatabaseConnection();
User::rmFromWishlist($db, intval($_GET['id']), $session->getId());

$session->addMessage('success', 'Book removed from wishlist!');

header('Location: ../pages/wishlist.php?username=' . $_GET['username']);