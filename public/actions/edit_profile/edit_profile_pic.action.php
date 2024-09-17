<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once (__DIR__ . '/../../../database/connection.db.php');
require_once (__DIR__ . '/../../../database/user.class.php');

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

move_uploaded_file($fileTmpName, __DIR__ . '/../../images/user_uploads/' . $imageName);

// Change profile picture

$db = getDatabaseConnection();

User::editProfilePic($db, $_GET['username'], $imageName);

header('Location: ../../pages/profile.php?username=' . $_GET['username']);