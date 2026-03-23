<?php
namespace App\Services;

use App\Core\AuthInterface;
use App\Models\Admin;
use App\Models\RegularUser;
use App\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function authenticate(string $email, string $password): bool
    {
        $record = $this->userRepository->findByEmail($email);

        if (!$record) {
            return false;
        }

        $user = $this->buildUserObject($record);
        return $this->loginUser($user, $email, $password);
    }

    private function loginUser(AuthInterface $user, string $email, string $password): bool
    {
        return $user->login($email, $password);
    }

    public function logoutCurrentUser(): void
    {
        if (!isset($_SESSION['current_user']['id'])) {
            unset($_SESSION['current_user']);
            return;
        }

        $record = $this->userRepository->findById((int) $_SESSION['current_user']['id']);

        if (!$record) {
            unset($_SESSION['current_user']);
            return;
        }

        $user = $this->buildUserObject($record);
        $user->logout();
    }

    private function buildUserObject(array $record): AuthInterface
    {
        if ($record['role'] === 'Admin') {
            return new Admin((int) $record['id'], $record['name'], $record['email'], $record['password_hash']);
        }

        return new RegularUser((int) $record['id'], $record['name'], $record['email'], $record['password_hash']);
    }
}
