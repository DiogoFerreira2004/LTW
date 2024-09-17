<?php
declare(strict_types=1);

class Book
{
    public ?int $id;
    public string $imagePath;
    public string $seller;
    public float $price;
    public string $title;
    public string $author;
    public string $genre;
    public string $publisher;
    public string $releaseDate;
    public string $condition;
    public int $isTradeable;
    public int $isAvailable;

    public function __construct(?int $id, string $imagePath, string $seller, float $price, string $title, string $author, string $genre, string $publisher, string $releaseDate, string $condition, int $isTradeable, int $isAvailable)
    {
        $this->id = $id;
        $this->imagePath = $imagePath;
        $this->seller = $seller === null ? '' : $seller;
        $this->price = $price;
        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->publisher = $publisher;
        $this->releaseDate = $releaseDate;
        $this->condition = $condition;
        $this->isTradeable = $isTradeable;
        $this->isAvailable = $isAvailable;
    }

    static function addBook(PDO $db, Book $book): void
    {
        $stmt = $db->prepare('INSERT INTO Book (imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$book->imagePath, $book->seller, $book->price, $book->title, $book->author, $book->genre, $book->publisher, $book->releaseDate, $book->condition, $book->isTradeable, $book->isAvailable]);
    }

    static function editBook(PDO $db, Book $book): void
    {
        $stmt = $db->prepare('UPDATE Book SET seller = ?, price = ?, nome = ?, author = ?, genre = ?, publisher = ?, publicationDate = ?, condition = ?, isTradeable = ?, isAvailable = ? WHERE idBook = ?');
        $stmt->execute([$book->seller, $book->price, $book->title, $book->author, $book->genre, $book->publisher, $book->releaseDate, $book->condition, $book->isTradeable, $book->isAvailable, $book->id]);
    }

    static function rmBook(PDO $db, int $id): void
    {
        $stmt = $db->prepare('UPDATE Book SET isAvailable = 0 WHERE idBook = ?');
        $stmt->execute([$id]);
    }

    static function getBooks(PDO $db): array
    {
        $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book WHERE isAvailable = 1');
        $stmt->execute();

        $books = array();
        while ($book = $stmt->fetch()) {
            $books[] = new Book(
                $book['idBook'],
                $book['imagePath'],
                $book['seller'],
                $book['price'],
                $book['nome'],
                $book['author'],
                $book['genre'],
                $book['publisher'],
                $book['publicationDate'],
                $book['condition'],
                $book['isTradeable'],
                $book['isAvailable']
            );
        }

        return $books;
    }

    static function getRecentBooks(PDO $db): array
    {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book WHERE isAvailable = 1 ORDER BY idBook DESC LIMIT 6');
        $stmt->execute();

        $books = array();
        while ($book = $stmt->fetch()) {
            $books[] = new Book(
                $book['idBook'],
                $book['imagePath'],
                $book['seller'],
                $book['price'],
                $book['nome'],
                $book['author'],
                $book['genre'],
                $book['publisher'],
                $book['publicationDate'],
                $book['condition'],
                $book['isTradeable'],
                $book['isAvailable']
            );
        }

        return $books;
    }

    static function getBooksForSale(PDO $db, string $seller): ?array
    {
        $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book WHERE seller = ?');
        $stmt->execute([$seller]);

        $books = array();
        while ($book = $stmt->fetch()) {
            $books[] = new Book(
                $book['idBook'],
                $book['imagePath'],
                $book['seller'],
                $book['price'],
                $book['nome'],
                $book['author'],
                $book['genre'],
                $book['publisher'],
                $book['publicationDate'],
                $book['condition'],
                $book['isTradeable'],
                $book['isAvailable']
            );
        }

        return $books;
    }

    static function getBook(PDO $db, int $id): Book
    {

        $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book WHERE idBook = ? AND isAvailable = 1');
        $stmt->execute([$id]);

        $book = $stmt->fetch();

        return new Book(
            $book['idBook'],
            $book['imagePath'],
            $book['seller'],
            $book['price'],
            $book['nome'],
            $book['author'],
            $book['genre'],
            $book['publisher'],
            $book['publicationDate'],
            $book['condition'],
            $book['isTradeable'],
            $book['isAvailable']
        );
    }

    static function getAllBooks(PDO $db, int $availability): array
    {
        if ($availability === 3) {
            $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book');
            $stmt->execute();
        } else {
            $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book WHERE isAvailable = ?');
            $stmt->execute([$availability]);
        }

        $books = array();
        while ($book = $stmt->fetch()) {
            $books[] = new Book(
                $book['idBook'],
                $book['imagePath'],
                $book['seller'],
                $book['price'],
                $book['nome'],
                $book['author'],
                $book['genre'],
                $book['publisher'],
                $book['publicationDate'],
                $book['condition'],
                $book['isTradeable'],
                $book['isAvailable']
            );
        }

        return $books;
    }

    static function searchBooks(PDO $db, string $search, string $genre, float $maxPrice): array
    {
        if ($maxPrice == -1) {
            $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book WHERE nome LIKE ? AND genre LIKE ? AND isAvailable = 1');
            $stmt->execute(['%' . $search . '%', '%' . $genre . '%']);
        }
        else {
            $stmt = $db->prepare('SELECT idBook, imagePath, seller, price, nome, author, genre, publisher, publicationDate, condition, isTradeable, isAvailable FROM Book WHERE nome LIKE ? AND genre LIKE ? AND price <= ? AND isAvailable = 1');
            $stmt->execute(['%' . $search . '%', '%' . $genre . '%', $maxPrice]);
        }
        

        $books = array();
        while ($book = $stmt->fetch()) {
            $books[] = new Book(
                $book['idBook'],
                $book['imagePath'],
                $book['seller'],
                $book['price'],
                $book['nome'],
                $book['author'],
                $book['genre'],
                $book['publisher'],
                $book['publicationDate'],
                $book['condition'],
                $book['isTradeable'],
                $book['isAvailable']
            );
        }

        return $books;
    }

    static function changeSellerUsername(PDO $db, string $oldUsername, string $newUsername): void
    {
        $stmt = $db->prepare('UPDATE Book SET seller = ? WHERE seller = ?');
        $stmt->execute([$newUsername, $oldUsername]);
    }


    static function deleteBook(PDO $db, int $id): void
    {
        $stmt = $db->prepare('DELETE FROM Book WHERE idBook = ?');
        $stmt->execute([$id]);
    }

    static function setIsAvailable(PDO $db, int $bookId, int $availability): void
    {
        $stmt = $db->prepare('UPDATE Book SET isAvailable = ? WHERE idBook = ?');
        $stmt->execute([$availability, $bookId]);
    }

}

