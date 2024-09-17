<?php
declare(strict_types=1);

class Comment {
    public int $id;
    public string $user;
    public int $idBook;
    public string $comment;
    public string $createdAt;
    public array $replies = [];

    public function __construct(int $id, ?string $user, int $idBook, string $comment, string $createdAt) {
        $this->id = $id;
        $this->user = $user;
        $this->idBook = $idBook;
        $this->comment = $comment;
        $this->createdAt = $createdAt;
    }

    public static function getComments(PDO $db, int $idBook): array {
        $stmt = $db->prepare('SELECT * FROM comments WHERE idBook = ? ORDER BY createdAt ASC');
        $stmt->execute([$idBook]);
        $comments = [];
        while ($row = $stmt->fetch()) {
            $comments[] = new Comment(
                (int)$row['id'],
                $row['user'],
                (int)$row['idBook'],
                $row['comment'],
                $row['createdAt'],
            );
        }
        return $comments;
    }

    public static function addComment(PDO $db, string $user, int $idBook, string $comment): void {
        $stmt = $db->prepare('INSERT INTO comments (user, idBook, comment) VALUES (?, ?, ?)');
        $stmt->execute([$user, $idBook, $comment]);
    }
}

class Reply {
    public int $id;
    public string $user;
    public int $idComment;
    public string $reply;
    public string $createdAt;

    public function __construct(int $id, ?string $user, int $idComment, string $reply, string $createdAt) {
        $this->id = $id;
        $this->user = $user === null ? '' : $user;
        $this->idComment = $idComment;
        $this->reply = $reply;
        $this->createdAt = $createdAt;
    }

    public function getId(): int { return $this->id; }

    public static function getReplies(PDO $db, int $idComment): array {
        $stmt = $db->prepare('SELECT * FROM replies WHERE idComment = ? ORDER BY createdAt ASC');
        $stmt->execute([$idComment]);
        $replies = [];
        while ($row = $stmt->fetch()) {
            $replies[] = new Reply(
                (int)$row['id'],
                $row['user'],
                (int)$row['idComment'],
                $row['reply'],
                $row['createdAt'],
            );
        }
        return $replies;
    }

    public static function addReply(PDO $db, string $user, int $idComment, string $reply): bool {
        $stmt = $db->prepare('INSERT INTO replies (user, idComment, reply) VALUES (?, ?, ?)');
        return $stmt->execute([$user, $idComment, $reply]);
    }

    public static function getComment(PDO $db, int $id): ?Comment {
        $stmt = $db->prepare('SELECT * FROM comments WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
    
        if ($row) {
            return new Comment(
                (int)$row['id'],
                $row['user'],
                (int)$row['idBook'],
                $row['commentId'] ? (int)$row['commentId'] : null,
                $row['comment'],
                $row['createdAt'],
                $row['updatedAt']
            );
        }
    
        return null;
    }
}
