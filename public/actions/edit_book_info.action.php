<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');

$db = getDatabaseConnection();

if ($_POST['subGenre'] != ''){
    $genre = $_POST['genre'] . ',' . $_POST['subGenre'];
}
else {
    $genre = $_POST['genre'];
}

if ($_POST['isTradeable']){
    $isTradeable = 1;
}
else{
    $isTradeable = 0;
}

$editedBook = new Book(
    intval($_GET['id']),
    '../populate_db/default_cover.jpg',
    $session->getUsername(),
    floatval($_POST['price']),
    $_POST['title'],
    $_POST['author'],
    $genre,
    $_POST['publisher'],
    $_POST['releaseDate'],
    $_POST['condition'],
    $isTradeable,
    1
);

Book::editBook($db, $editedBook);

header("Location: ../pages/book.php?id=" . $_GET['id']);