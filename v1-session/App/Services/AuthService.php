<?php
namespace App\Services;

use App\Core\AuthInterface;

class AuthService
{
    public function authenticate(AuthInterface $user, string $email, string $password): bool
    {
        return $user->login($email, $password);
    }
}
