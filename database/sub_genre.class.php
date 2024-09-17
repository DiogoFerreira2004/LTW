<?php
declare(strict_types=1);

class SubGenre
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

    static function getAllSubGenres(PDO $db): ?array
    {
        $stmt = $db->prepare('SELECT * FROM SubGenres');
        $stmt->execute();

        $genres = array();
        while ($genre = $stmt->fetch()) {
            $genres[] = new SubGenre($genre['idSubGenre'], $genre['nome'], $genre['valor']);
        }

        return $genres;
    }

    static function addSubGenre(PDO $db, string $name, string $value): void
    {
        $stmt = $db->prepare('INSERT INTO SubGenres (nome, valor) VALUES (?, ?)');
        $stmt->execute([$name, $value]);
    }

    static function deleteSubGenre(PDO $db, int $id): void
    {
        $stmt = $db->prepare('DELETE FROM SubGenres WHERE idSubGenre = ?');
        $stmt->execute([$id]);
    }

    static function checkSubGenre(PDO $db, string $name): bool
    {
        $stmt = $db->prepare('SELECT * FROM SubGenres WHERE nome = ?');
        $stmt->execute([$name]);
        $subGenre = $stmt->fetch();

        return $subGenre ? true : false;
    }
}