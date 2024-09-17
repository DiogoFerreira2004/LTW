<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/profile.tpl.php');

$db = getDatabaseConnection();

$user = User::getUser($db, $_GET['username']);
$booksForSale = Book::getBooksForSale($db, $user->username);

drawHeader($session);
drawProfile($user, $booksForSale, $session);

if ($session->getId() == $user->id){
    drawEditProfile($session, $user);
}

drawFooter();