<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

$db = getDatabaseConnection();
$user = User::validateLogin($db, $_POST['email'], $_POST['password']);

if ($user) {
    $session->setId($user->id);
    $session->setName($user->name);
    $session->setUsername($user->username);
    $session->addMessage('success', 'Login successful!');

    if ($user->isAdmin) {
        $session->setAdmin();
    }

    header('Location: ../pages/home.php');
} else {
    $session->setLastEmailUsed($_POST['email']);
    $session->addMessage('error', "Error: You can't log in with those credentials!");

    header('Location: ../pages');
}