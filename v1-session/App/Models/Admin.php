<?php
namespace App\Models;

use App\Core\AbstractUser;
use App\Core\AuthInterface;
use App\Core\LoggerTrait;

class Admin extends AbstractUser implements AuthInterface
{
    use LoggerTrait;

    public function userRole(): string
    {
        return 'Admin';
    }

    public function login(string $email, string $password): bool
    {
        if ($email === $this->email && password_verify($password, $this->passwordHash)) {
            $_SESSION['current_user'] = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->userRole(),
            ];
            $this->logActivity("Admin {$this->name} logged in");
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        $this->logActivity("Admin {$this->name} logged out");
        unset($_SESSION['current_user']);
    }
}
