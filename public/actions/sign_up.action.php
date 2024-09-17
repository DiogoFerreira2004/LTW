<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');

require_once (__DIR__ . '/../utils/sign_up_validator.php');


if (validateSignUp($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['r_password'], $password_hash, $error_message)) {
    $db = getDatabaseConnection();

    if (User::emailExists($db, $_POST['email'])) {          // Check if email already exists
        $session->addMessage('error', 'Error: Email already taken.');
        header('Location: ../pages/sign_up.php');
        exit();
    }

    if (User::usernameExists($db, $_POST['username'])) {    // Check if username already exists
        $session->addMessage('error', 'Error: Username already taken.');
        header('Location: ../pages/sign_up.php');
        exit();
    }

    User::createUser($db, $_POST['name'], $_POST['username'], $_POST['email'], $password_hash); // Create user

    $session->setLastEmailUsed($_POST['email']);
    $session->addMessage('success', 'Sign up successfull! You can now log in.');

    header('Location: ../pages');
} else {
    $session->addMessage('error', 'Error: ' . $error_message);

    header('Location: ../pages/sign_up.php');
}