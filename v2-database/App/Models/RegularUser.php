<?php
namespace App\Models;

use App\Core\AbstractUser;
use App\Core\AuthInterface;
use App\Core\LoggerTrait;

class RegularUser extends AbstractUser implements AuthInterface
{
    use LoggerTrait;

    public function userRole(): string
    {
        return 'Regular User';
    }

    public function login(string $email, string $password): bool
    {
        if ($email === $this->email && password_verify($password, $this->passwordHash)) {
            $_SESSION['current_user'] = [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->userRole(),
            ];
            $this->logActivity("User {$this->name} logged in", $this->id);
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        $this->logActivity("User {$this->name} logged out", $this->id);
        unset($_SESSION['current_user']);
    }
}
