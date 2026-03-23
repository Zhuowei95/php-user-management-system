<?php
namespace App\Core;

abstract class AbstractUser
{
    protected string $name;
    protected string $email;
    protected string $passwordHash;

    public function __construct(string $name, string $email, string $plainPassword, bool $alreadyHashed = false)
    {
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $alreadyHashed ? $plainPassword : password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    abstract public function userRole(): string;
}
