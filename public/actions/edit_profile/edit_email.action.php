<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/user.class.php');

$db = getDatabaseConnection();

$updated = User::editEmail($db, $_GET['username'], $_POST['old_email'], $_POST['new_email']);

if ($updated === 0) {
    $session->addMessage('success', 'Email updated successfully!');
} else if ($updated === 1) {
    $session->addMessage('error', 'Email already exists!');
} else {
    $session->addMessage('error', 'Current email does not match!');
}

header('Location: ../../pages/profile.php?username=' . $_GET['username']);