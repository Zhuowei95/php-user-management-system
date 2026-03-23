<?php
require_once __DIR__ . '/bootstrap.php';

use App\Models\Admin;
use App\Models\RegularUser;
use App\Services\UserStorage;

if (isset($_SESSION['current_user'])) {
    $record = UserStorage::findByEmail($_SESSION['current_user']['email']);

    if ($record) {
        $user = $record['role'] === 'Admin'
            ? new Admin($record['name'], $record['email'], $record['password_hash'], true)
            : new RegularUser($record['name'], $record['email'], $record['password_hash'], true);

        $user->logout();
    } else {
        unset($_SESSION['current_user']);
    }
}

header('Location: index.php');
exit;
