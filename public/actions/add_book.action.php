<?php
declare(strict_types=1);

require_once (__DIR__ . '/../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../database/connection.db.php');
require_once (__DIR__ . '/../../database/book.class.php');

// Input file validation

if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
    $session->addMessage('error', 'No file uploaded! Please upload a PNG or JPEG/JPG file.');

    header('Location: ../pages/add_book.php');
    exit();
}

$fileName = $_FILES['image']['name'];
$fileSize = $_FILES['image']['size'];
$fileTmpName = $_FILES['image']['tmp_name'];

$validExtensions = array('png', 'jpeg', 'jpg');
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if (!in_array($fileExtension, $validExtensions)){
    $session->addMessage('error', 'Invalid file extension! Please upload a PNG or JPEG/JPG file.');

    header('Location: ../pages/add_book.php');
    exit();
}

if ($fileSize > 2097152){
    $session->addMessage('error', 'File size is too large! Please upload a file smaller than 2MB.');

    header('Location: ../pages/add_book.php');
    exit();
}

$imageName = uniqid() . '.' . $fileExtension;

move_uploaded_file($fileTmpName, __DIR__ . '/../images/user_uploads/' . $imageName);

// Creating a new book

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

$newBook = new Book(
    NULL,
    $imageName,
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

Book::addBook($db, $newBook);

$session->addMessage('success', 'Book added successfully!');
header('Location: ../pages/add_book.php');