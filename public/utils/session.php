<?php
class Session
{
    private array $messages;

    public function __construct()
    {
        session_start();

        $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
        unset($_SESSION['messages']);
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['id']);
    }

    public function logout()
    {
        session_destroy();
    }

    public function getId(): ?int
    {
        return isset($_SESSION['id']) ? $_SESSION['id'] : null;
    }

    public function getName(): ?string
    {
        return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function getUsername(): ?string
    {
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function setId(int $id)
    {
        $_SESSION['id'] = $id;
    }

    public function setName(string $name)
    {
        $_SESSION['name'] = $name;
    }

    public function setUsername(string $username)
    {
        $_SESSION['username'] = $username;
    }

    public function addMessage(string $type, string $text)
    {
        $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function setLastEmailUsed(string $email)
    {
        $_SESSION['lastEmailUsed'] = $email;
    }

    public function getLastEmailUsed(): string
    {
        return isset($_SESSION['lastEmailUsed']) ? $_SESSION['lastEmailUsed'] : '';
    }

    public function isAdmin(): bool
    {
        return isset($_SESSION['admin']) && $_SESSION['admin'];
    }

    public function setAdmin()
    {
        $_SESSION['admin'] = true;
    }
}
