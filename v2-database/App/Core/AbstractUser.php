<?php
namespace App\Core;

abstract class AbstractUser
{
    protected ?int $id;
    protected string $name;
    protected string $email;
    protected string $passwordHash;

    public function __construct(?int $id, string $name, string $email, string $passwordHash)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function getId(): ?int
    {
        return $this->id;
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
