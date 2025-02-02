<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/user.class.php');

$db = getDatabaseConnection();

User::makeAdmin($db, intval($_GET['id']));

header('Location: ../../pages/users.admin.php');