<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/genre.class.php');

$db = getDatabaseConnection();

if (Genre::checkGenre($db, $_POST['genre'])) {
    header('Location: ../../pages/genres.admin.php');
    exit();
}

$value = strtolower($_POST['genre']);

Genre::addGenre($db, $_POST['genre'], $value);

header('Location: ../../pages/genres.admin.php');