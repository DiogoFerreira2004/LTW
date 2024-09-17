<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/user.class.php');

$db = getDatabaseConnection();

$updated = User::editPassword($db, $_GET['username'], $_POST['old_password'], $_POST['new_password'], $_POST['confirm_password']);

if ($updated == 0){
    $session->addMessage('success', 'Password updated successfully!');
}
else if ($updated == 1){
    $session->addMessage('error', 'Password must be at least 6 characters!');
}
else if ($updated == 2){
    $session->addMessage('error', 'Password must contain at least one letter!');
}
else if ($updated == 3){
    $session->addMessage('error', 'Password must contain at least one number!');
}
else if ($updated == 4){
    $session->addMessage('error', 'Passwords do not match!');
}
else {
    $session->addMessage('error', 'Current password does not match!');
}

header('Location: ../../pages/profile.php?username=' . $_GET['username']);