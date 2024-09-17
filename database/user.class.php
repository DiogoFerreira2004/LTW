<?php
declare(strict_types=1);

class User
{
    public int $id;
    public string $profilePic;
    public string $name;
    public string $username;
    public string $email;
    public int $isAdmin;

    public function __construct(int $id, string $profilePic, string $name, string $username, string $email, int $isAdmin = 0)
    {
        $this->id = $id;
        $this->profilePic = $profilePic;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }

    static function createUser(PDO $db, string $name, string $username, string $email, string $password): void
    {
        $stmt = $db->prepare('INSERT INTO User (nome, username, email, userPassword) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $username, strtolower($email), $password]);
    }

    static function getUser(PDO $db, string $username): User
    {
        $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        return new User($user['idUser'], $user['profilePic'], $user['nome'], $user['username'], $user['email']);
    }

    static function getAllUsers(PDO $db): ?array
    {
        $stmt = $db->prepare('SELECT * FROM User');
        $stmt->execute();

        $users = array();
        while ($user = $stmt->fetch()) {
            $users[] = new User($user['idUser'], $user['profilePic'], $user['nome'], $user['username'], $user['email'], $user['isAdmin']);
        }

        return $users;
    }

    static function emailExists(PDO $db, string $email): bool
    {
        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        return $user ? true : false;
    }

    static function usernameExists(PDO $db, string $username): bool
    {
        $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        return $user ? true : false;
    }

    static function editProfilePic(PDO $db, string $username, string $imageName): void
    {
        $stmt = $db->prepare('UPDATE User SET profilePic = ? WHERE username = ?');
        $stmt->execute([$imageName, $username]);
    }

    static function editName(PDO $db, string $username, string $name): void
    {
        $stmt = $db->prepare('UPDATE User SET nome = ? WHERE username = ?');
        $stmt->execute([$name, $username]);
    }

    static function editUsername(PDO $db, string $username, string $newUsername): bool
    {
        if (User::usernameExists($db, $newUsername)) {
            return false;   // Username already exists
        }

        $stmt = $db->prepare('UPDATE User SET username = ? WHERE username = ?');
        $stmt->execute([$newUsername, $username]);

        return true;    // Username updated successfully
    }

    static function editEmail(PDO $db, string $username, string $oldEmail, string $newEmail): int
    {
        if (User::emailExists($db, $newEmail)) {
            return 1;   // Email already exists
        }

        $stmt = $db->prepare('SELECT email FROM User WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($oldEmail !== $user['email']) {
            return 2;   // Old email is incorrect
        }

        $stmt = $db->prepare('UPDATE User SET email = ? WHERE username = ?');
        $stmt->execute([strtolower($newEmail), $username]);

        return 0;    // Email updated successfully
    }

    static function editPassword(PDO $db, string $username, string $oldPassword, string $newPassword, string $confirmPassword): int
    {
        if (strlen($newPassword) < 6) {
            return 1;   // Password must be at least 6 characters
        }
    
        if (!preg_match("/[a-z]/i", $newPassword)) {
            return 2;   // Password must contain at least one letter
        }
    
        if (!preg_match("/[0-9]/", $newPassword)) {
            return 3;   // Password must contain at least one number
        }
    
        if ($newPassword !== $confirmPassword) {
            return 4;   // Passwords do not match
        }
        
        $stmt = $db->prepare('SELECT userPassword FROM User WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if (!password_verify($oldPassword, $user['userPassword'])) {
            return 5;   // Old password is incorrect
        }

        $stmt = $db->prepare('UPDATE User SET userPassword = ? WHERE username = ?');
        $stmt->execute([password_hash($newPassword, PASSWORD_DEFAULT), $username]);

        return 0;    // Password updated successfully
    }

    static function validateLogin(PDO $db, string $email, string $password): ?User
    {
        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute([strtolower($email)]);
        $user = $stmt->fetch();

        if (!$user) {
            return null;
        }

        if (password_verify($password, $user['userPassword'])) {
            return new User($user['idUser'], $user['profilePic'], $user['nome'], $user['username'], $user['email'], $user['isAdmin']);
        } else {
            return null;
        }
    }

    static function addToCart(PDO $db, int $idBook, int $idUser): bool
    {
        $stmt = $db->prepare('SELECT * FROM Cart WHERE buyer = ? AND bookToBuy = ?');
        $stmt->execute([$idUser, $idBook]);
        $cart = $stmt->fetch();

        if ($cart) {
            // Book already in cart
            return false;
        }

        $stmt = $db->prepare('INSERT INTO Cart (buyer, bookToBuy) VALUES (?, ?)');
        $stmt->execute([$idUser, $idBook]);

        return true;
    }

    static function rmFromCart(PDO $db, int $idBook, int $idUser): void
    {
        $stmt = $db->prepare('DELETE FROM Cart WHERE buyer = ? AND bookToBuy = ?');
        $stmt->execute([$idUser, $idBook]);
    }

    static function addToWishlist(PDO $db, int $idBook, int $idUser): bool
    {
        $stmt = $db->prepare('SELECT * FROM Wishlist WHERE buyer = ? AND bookToBuy = ?');
        $stmt->execute([$idUser, $idBook]);
        $wishlist = $stmt->fetch();

        if ($wishlist) {
            // Book already in cart
            return false;
        }

        $stmt = $db->prepare('INSERT INTO Wishlist (buyer, bookToBuy) VALUES (?, ?)');
        $stmt->execute([$idUser, $idBook]);

        return true;
    }

    static function rmFromWishlist(PDO $db, int $idBook, int $idUser): void
    {
        $stmt = $db->prepare('DELETE FROM Wishlist WHERE buyer = ? AND bookToBuy = ?');
        $stmt->execute([$idUser, $idBook]);
    }

    static function getCart(PDO $db, int $idUser) : ?array
    {
        $stmt = $db->prepare('SELECT bookToBuy FROM Cart WHERE buyer = ?');
        $stmt->execute([$idUser]);

        $bookIds = array();
        while ($book = $stmt->fetch()) {
            $bookIds[] = $book['bookToBuy'];
        }

        return $bookIds;
    }

    static function getWishlist(PDO $db, int $idUser) : ?array
    {
        $stmt = $db->prepare('SELECT bookToBuy FROM Wishlist WHERE buyer = ?');
        $stmt->execute([$idUser]);

        $bookIds = array();
        while ($book = $stmt->fetch()) {
            $bookIds[] = $book['bookToBuy'];
        }

        return $bookIds;
    }

    static function makeAdmin(PDO $db, int $idUser): void
    {
        $stmt = $db->prepare('UPDATE User SET isAdmin = 1 WHERE idUser = ?');
        $stmt->execute([$idUser]);
    }

    static function deleteUser(PDO $db, string $username): void
    {
        $stmt = $db->prepare('DELETE FROM User WHERE username = ?');
        $stmt->execute([$username]);
    }
}
