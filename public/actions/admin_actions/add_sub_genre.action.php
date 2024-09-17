<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/sub_genre.class.php');

$db = getDatabaseConnection();

if (SubGenre::checkSubGenre($db, $_POST['subGenre'])){
    header('Location: ../../pages/genres.admin.php');
    exit();
}

$value = strtolower($_POST['subGenre']);

SubGenre::addSubGenre($db, $_POST['subGenre'], $value);

header('Location: ../../pages/genres.admin.php');