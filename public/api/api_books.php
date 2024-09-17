<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../../database/connection.db.php');
  require_once(__DIR__ . '/../../database/book.class.php');

  $db = getDatabaseConnection();

  if ($_GET['maxPrice'] === -1) {
    $_GET['maxPrice'] = -1;
  }
  else {
    $_GET['maxPrice'] = floatval($_GET['maxPrice']);
  }

  $books = Book::searchBooks($db, $_GET['search'], $_GET['genre'], $_GET['maxPrice']);

  echo json_encode($books);
