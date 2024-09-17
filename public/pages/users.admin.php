<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/user.class.php');
require_once (__DIR__ . '/../templates/home.tpl.php');
require_once (__DIR__ . '/../templates/admin.tpl.php');
require_once (__DIR__ . '/../templates/admin_templates/users.admin.tpl.php');

$db = getDatabaseConnection();

$users = User::getAllUsers($db);

drawHeader($session);
drawAdminUsers($users);
drawFooter();