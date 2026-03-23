<?php
namespace App\Repositories;

use App\Config\Database;
use PDO;

class UserRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function create(string $name, string $email, string $password, string $role = 'Regular User'): bool
    {
        $sql = 'INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)';
        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ':name' => $name,
            ':email' => $email,
            ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ':role' => $role,
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $statement->execute([':email' => $email]);
        $user = $statement->fetch();

        return $user ?: null;
    }

    public function findById(int $id): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $statement->execute([':id' => $id]);
        $user = $statement->fetch();

        return $user ?: null;
    }

    public function all(): array
    {
        $statement = $this->connection->query('SELECT id, name, email, role, created_at FROM users ORDER BY id ASC');
        return $statement->fetchAll();
    }
}
