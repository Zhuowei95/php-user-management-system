<?php
namespace App\Services;

class UserStorage
{
    public static function seedDemoUsers(): void
    {
        if (!isset($_SESSION['users'])) {
            $_SESSION['users'] = [
                [
                    'name' => 'Alice',
                    'email' => 'alice@example.com',
                    'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                    'role' => 'Admin',
                ],
                [
                    'name' => 'Bob',
                    'email' => 'bob@example.com',
                    'password_hash' => password_hash('user123', PASSWORD_DEFAULT),
                    'role' => 'Regular User',
                ],
            ];
        }
    }

    public static function addUser(string $name, string $email, string $password, string $role = 'Regular User'): void
    {
        $_SESSION['users'][] = [
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
        ];
    }

    public static function findByEmail(string $email): ?array
    {
        foreach ($_SESSION['users'] as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }

        return null;
    }

    public static function all(): array
    {
        return $_SESSION['users'] ?? [];
    }
}
