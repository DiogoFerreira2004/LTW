<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/user.class.php');

$db = getDatabaseConnection();

User::editName($db, $_GET['username'], $_POST['name']);

$session->setName($_POST['name']);
$session->addMessage('success', 'Name updated successfully!');

header('Location: ../../pages/profile.php?username=' . $_GET['username']);