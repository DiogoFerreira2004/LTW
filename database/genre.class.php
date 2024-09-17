<?php
declare(strict_types=1);

class Genre
{
    public int $id;
    public string $name;
    public string $value;

    public function __construct(int $id, string $name, string $value)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    static function getAllGenres(PDO $db): ?array
    {
        $stmt = $db->prepare('SELECT * FROM Genres');
        $stmt->execute();

        $genres = array();
        while ($genre = $stmt->fetch()) {
            $genres[] = new Genre($genre['idGenre'], $genre['nome'], $genre['valor']);
        }

        return $genres;
    }

    static function addGenre(PDO $db, string $name, string $value): void
    {
        $stmt = $db->prepare('INSERT INTO Genres (nome, valor) VALUES (?, ?)');
        $stmt->execute([$name, $value]);
    }

    static function deleteGenre(PDO $db, int $id): void
    {
        $stmt = $db->prepare('DELETE FROM Genres WHERE idGenre = ?');
        $stmt->execute([$id]);
    }

    static function checkGenre(PDO $db, string $name): bool
    {
        $stmt = $db->prepare('SELECT * FROM Genres WHERE nome = ?');
        $stmt->execute([$name]);
        $genre = $stmt->fetch();

        return $genre ? true : false;
    }
}