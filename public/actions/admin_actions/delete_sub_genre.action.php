<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/sub_genre.class.php');

$db = getDatabaseConnection();

SubGenre::deleteSubGenre($db, intval($_GET['id']));

header('Location: ../../pages/genres.admin.php');